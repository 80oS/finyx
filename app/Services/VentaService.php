<?php
namespace App\Services;

use App\Models\factura;
use App\Models\Producto;
use App\Repositories\VentaRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentaService{
    private VentaRepository $venta_repository;

    public function __construct(VentaRepository $venta_repository)
    {
        $this->venta_repository = $venta_repository;
    }

    public function index()
    {
        return $this->venta_repository->index();
    }

    public function create(array $datos)
    {
        return DB::transaction(function () use ($datos) {

            $productos = $datos['productos'];

            $subtotal = 0;
            $totalImpuestos = 0;
            $detalles = [];

            $fechaVenta = Carbon::now();

            foreach ($productos as $item) {

                $producto = Producto::findOrFail($item['id_producto']);

                $cantidad = (float) $item['cantidad'];

                $resultado = app(CalculoImpuestosService::class)
                    ->calcularProducto($producto, $cantidad, $fechaVenta);

                $subtotal += $resultado['subtotal'];
                $totalImpuestos += $resultado['total_impuestos'];

                $detalles[] = [
                    'id_producto' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $producto->precio_unitario,
                    'subtotal' => $resultado['subtotal'],
                    'valor_impuesto' => $resultado['total_impuestos'],
                    'total' => $resultado['total'],
                ];
            }

            unset($datos['productos']);

            $datos['subtotal'] = round($subtotal, 2);
            $datos['total_impuestos'] = round($totalImpuestos, 2);
            $datos['total'] = round($subtotal + $totalImpuestos, 2);

            // Enviar los detalles calculados al Repository
            $datos['productos'] = $detalles;

            return $this->venta_repository->create($datos);
        });
    }

    public function show(int $id)
    {
        $factura = $this->venta_repository->show($id);

        $totales = $this->calcularTotalesFactura($factura);

        return [
            'factura' => $factura,
            'totales' => $totales,
        ];
    }

    private function obtenerImpuestosProducto(
        Producto $producto,
        Carbon $fechaVenta
    ) {
        return DB::table('impuesto_producto as ip')
            ->join('impuesto as i', 'i.id', '=', 'ip.id_impuesto')
            ->where('ip.id_producto', $producto->id)
            ->where('ip.estado', 1)
            ->whereDate('ip.fecha_inicio', '<=', $fechaVenta->toDateString())
            ->where(function ($query) use ($fechaVenta) {
                $query->whereNull('ip.fecha_fin')
                    ->orWhereDate(
                        'ip.fecha_fin',
                        '>=',
                        $fechaVenta->toDateString()
                    );
            })
            ->select([
                'ip.id_impuesto',
                'ip.tarifa_aplicada',
                'i.nombre',
            ])
            ->get();
    }

    private function calcularImpuestosProducto(
        Producto $producto,
        int $cantidad,
        Carbon $fechaVenta
    ): array {

        $baseGravable = round(
            $producto->precio_unitario * $cantidad,
            2
        );

        $impuestos = $this->obtenerImpuestosProducto(
            $producto,
            $fechaVenta
        );

        $totalImpuestos = 0;
        $detalleImpuestos = [];

        foreach ($impuestos as $impuesto) {

            $tarifa = (float) $impuesto->tarifa_aplicada;

            $valorImpuesto = round(
                $baseGravable * ($tarifa / 100),
                2
            );

            $totalImpuestos += $valorImpuesto;

            $detalleImpuestos[] = [
                'id_impuesto' => $impuesto->id_impuesto,
                'nombre_impuesto' => $impuesto->nombre,
                'tarifa_aplicada' => $tarifa,
                'base_gravable' => $baseGravable,
                'valor_impuesto' => $valorImpuesto,
            ];
        }

        return [
            'base_gravable' => $baseGravable,
            'impuestos' => $detalleImpuestos,
            'total_impuestos' => round($totalImpuestos, 2),
            'total' => round($baseGravable + $totalImpuestos, 2),
        ];
    }

    public function calcularTotalesFactura(Factura $factura): array
    {
        $detalles = $factura->detalleFactura;

        $subtotal = $detalles->sum('subtotal');

        // Tomar el total almacenado en la factura.
        $total = (float) $factura->total;

        $totalImpuestos = $total - $subtotal;

        return [
            'subtotal' => round($subtotal, 2),
            'total_impuestos' => round($totalImpuestos, 2),
            'total' => round($total, 2),
        ];
    }
}
?>