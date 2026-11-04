<?php

namespace App\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductoMasVendido extends Component
{
    public int $pagina = 1;

    public ?int $mes = null;
    public ?int $anio = null;

    protected int $primeraPagina = 3;
    protected int $porPagina = 3;

    public function updatedMes(): void
    {
        $this->pagina = 1;
    }

    public function updatedAnio(): void
    {
        $this->pagina = 1;
    }

    public function limpiar(): void
    {
        $this->mes = null;
        $this->anio = null;
        $this->pagina = 1;
    }

    public function irA(int $pagina): void
    {
        $this->pagina = max(1, $pagina);
    }

    public function anterior(): void
    {
        $this->pagina = max(1, $this->pagina - 1);
    }

    public function siguiente(): void
    {
        $this->pagina++;
    }

    public function render()
    {
        $total = Producto::count();

        $ultimaPagina = $total <= $this->primeraPagina
            ? 1
            : 1 + (int) ceil(($total - $this->primeraPagina) / $this->porPagina);

        $this->pagina = min(max($this->pagina, 1), $ultimaPagina);

        $offset = $this->pagina === 1
            ? 0
            : $this->primeraPagina + ($this->pagina - 2) * $this->porPagina;

        $limite = $this->pagina === 1 ? $this->primeraPagina : $this->porPagina;

        // Subconsulta: unidades vendidas, filtrando por mes y/o año de la factura
        $totalVendido = DB::table('detalle_factura')
            ->join('factura', 'factura.id', '=', 'detalle_factura.id_factura')
            ->selectRaw('SUM(detalle_factura.cantidad)')
            ->whereColumn('detalle_factura.id_producto', 'producto.id')
            ->when($this->anio, fn ($q) => $q->whereRaw("strftime('%Y', factura.created_at) = ?", [(string) $this->anio]))
            ->when($this->mes, fn ($q) => $q->whereRaw("strftime('%m', factura.created_at) = ?", [str_pad($this->mes, 2, '0', STR_PAD_LEFT)]));

        $masVendidos = Producto::select('id', 'nombre', 'codigo')
            ->selectSub($totalVendido, 'total_vendido')
            ->orderByDesc('total_vendido')
            ->orderBy('id')
            ->offset($offset)
            ->limit($limite)
            ->get();

        $anios = DB::table('factura')
            ->selectRaw("DISTINCT strftime('%Y', created_at) AS anio")
            ->orderByDesc('anio')
            ->pluck('anio');

        return view('livewire.producto-mas-vendido', [
            'masVendidos'  => $masVendidos,
            'total'        => $total,
            'ultimaPagina' => $ultimaPagina,
            'desde'        => $offset + 1,
            'anios'        => $anios,
        ]);
    }
}