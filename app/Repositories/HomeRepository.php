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

    public function totalProductos(): int
    {
        return DB::table('producto')->count();
    }

    public function ventasPorCategoria()
    {
        return DB::select("
            SELECT
              categoria.nombre,
              (SELECT COALESCE(SUM(detalle_factura.subtotal), 0)
                 FROM detalle_factura
                 JOIN producto ON producto.id = detalle_factura.id_producto
                WHERE producto.id_categoria = categoria.id) AS total_ventas
            FROM categoria
        ");
    }

    public function totalFacturas(): int
    {
        $resultado = DB::select("
            SELECT (SELECT COUNT(*) FROM factura) AS total_facturas
        ");

        return $resultado[0]->total_facturas;
    }

    public function facturasRecientes(): array
    {  
        return DB::select("
            SELECT
            factura.codigo,
            factura.estado,
            factura.total,
            (SELECT cliente.nombre
                FROM cliente
                WHERE cliente.id = factura.id_cliente) AS cliente
            FROM factura
            ORDER BY factura.id DESC
            LIMIT 3
        ");
    }

        public function ventasHoy(): float
    {
        $r = DB::select("
            SELECT COALESCE(
            (SELECT SUM(total)
                FROM factura
                WHERE estado = 'pagado'
                AND date(created_at) = date('now', 'localtime')),
            0) AS total_hoy
        ");

        return (float) $r[0]->total_hoy;
    }

    public function ventasPorDia(): array
    {
        return DB::select("
            SELECT
            dias.fecha,
            (SELECT SUM(f.total)
                FROM factura f
                WHERE f.estado = 'pagado'
                AND date(f.created_at) = dias.fecha) AS total_dia
            FROM (SELECT DISTINCT date(created_at) AS fecha FROM factura) dias
            ORDER BY dias.fecha DESC
            LIMIT 7
        ");
    }
}