<?php

namespace App\Services;

use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CalculoImpuestosService{
    public function calcularProducto(
        Producto $producto,
        float $cantidad,
        ?Carbon $fechaVenta = null
    ): array {
        $fechaVenta ??= Carbon::now();

        $baseGravable = round(
            $producto->precio_unitario * $cantidad,
            2
        );

        $impuestos = DB::table('impuesto_producto as ip')
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

        $totalImpuestos = 0;

        foreach ($impuestos as $impuesto) {
            $tarifa = (float) $impuesto->tarifa_aplicada;

            $valor = round(
                $baseGravable * ($tarifa / 100),
                2
            );

            $totalImpuestos += $valor;
        }

        return [
            'subtotal' => $baseGravable,
            'total_impuestos' => round($totalImpuestos, 2),
            'total' => round($baseGravable + $totalImpuestos, 2),
        ];
    }
}

?>