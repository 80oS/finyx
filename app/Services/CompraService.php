<?php
namespace App\Services;

use App\Repositories\CompraRepository;
use Illuminate\Support\Facades\DB;

class CompraService{

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

       public function registrar(int $idProveedor, string $metodoPago, array $items)
    {
        DB::transaction(function () use ($idProveedor, $metodoPago, $items) {

            $compra = $this->compra_repository->crear([
                'id_proveedor' => $idProveedor,
                'metodo_pago'  => $metodoPago,
                'total'        => collect($items)->sum(fn ($i) => $i['cantidad'] * $i['precio']),
            ]);

            foreach ($items as $item) {
                $this->compra_repository->crearDetalle([
                    'id_compra'       => $compra->id,
                    'id_producto'     => $item['id_producto'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal'        => $item['cantidad'] * $item['precio'],
                ]);

                $this->compra_repository->aumentarStock($item['id_producto'], $item['cantidad']);
            }
        });
    }
}