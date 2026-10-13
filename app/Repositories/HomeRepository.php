<?php

namespace App\Repositories;

use App\Models\producto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomeRepository
{
    public function index(): int
    {
        return producto::count();
    }

    public function stockMinimo(): Collection
    {
        return producto::select('nombre', 'codigo', 'stock')
            ->where('stock', '<', producto::selectRaw('AVG(stock)'))
            ->get();
    }

    public function masVendidos(): Collection
    {
        $totalVendido = DB::table('detalle_factura')
            ->selectRaw('SUM(cantidad)')
            ->whereColumn('detalle_factura.id_producto', 'producto.id');

        return producto::select('nombre', 'codigo')
            ->selectSub($totalVendido, 'total_vendido')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();
    }
}