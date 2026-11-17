<?php
namespace App\Services;

use App\Repositories\CompraRepository;
use Illuminate\Support\Facades\DB;

class CompraService
{
    private CompraRepository $compra_repository;

    public function __construct(CompraRepository $compra_repository)
    {
        $this->compra_repository = $compra_repository;
    }

    public function index()
    {
        return $this->compra_repository->index();
    }

    public function crear(array $datos)
    {
        return $this->compra_repository->crear($datos);
    }

    public function buscarId(int $id)
    {
        return $this->compra_repository->buscarId($id);
    }

    public function update(int $id, array $datos)
    {
        return $this->compra_repository->update($id, $datos);
    }

    public function eliminar(int $id)
    {
        DB::transaction(function () use ($id) {
            $this->compra_repository->eliminar($id);
        });
    }

    public function calcularLinea(array $l): array
    {
        $subtotal = ($l['cantidad'] ?: 0) * ($l['precio'] ?: 0);
        $iva      = $subtotal * ($l['iva'] ?: 0) / 100;

        return [
            'subtotal' => $subtotal,
            'iva'      => $iva,
            'total'    => $subtotal + $iva,
        ];
    }

    public function calcularTotales(array $items, float $descuento = 0): array
    {
        $subtotal = 0;
        $iva = 0;

        foreach ($items as $item) {
            $linea = $this->calcularLinea($item);
            $subtotal += $linea['subtotal'];
            $iva += $linea['iva'];
        }

        return [
            'subtotal' => $subtotal,
            'iva'      => round($iva, 2),
            'total'    => max(0, $subtotal + $iva - $descuento),
        ];
    }

    public function registrar(int $idProveedor, string $metodoPago, array $items, float $descuento = 0): array
    {
        return DB::transaction(function () use ($idProveedor, $metodoPago, $items, $descuento) {

            $totales = $this->calcularTotales($items, $descuento);

            $compra = $this->compra_repository->crear([
                'id_proveedor' => $idProveedor,
                'metodo_pago'  => $metodoPago,
                'iva'          => $totales['iva'],
                'descuento'    => $descuento,
                'total'        => $totales['total'],
            ]);

            $sinInventario = [];

            foreach ($items as $item) {
                $this->compra_repository->crearDetalle([
                    'id_compra'       => $compra->id,
                    'nombre_producto' => $item['nombre'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal'        => $this->calcularLinea($item)['subtotal'],
                ]);

                $actualizado = $this->compra_repository->aumentarStockPorNombre($item['nombre'], (int) $item['cantidad'],  (float) $item['precio']);

                if (!$actualizado) {
                    $sinInventario[] = $item['nombre'];
                }
            }

            return ['compra' => $compra, 'sin_inventario' => $sinInventario];
        });
    }
}