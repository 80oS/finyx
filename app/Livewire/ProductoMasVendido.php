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
    $anio = $this->anio ? (string) $this->anio : null;
    $mes  = $this->mes ? str_pad($this->mes, 2, '0', STR_PAD_LEFT) : null;

    $vendidos = Producto::select('id', 'nombre', 'codigo')
        ->selectRaw("(SELECT SUM(d.cantidad)
                      FROM detalle_factura d
                      JOIN factura f ON f.id = d.id_factura
                      WHERE d.id_producto = producto.id
                      AND (? IS NULL OR strftime('%Y', f.created_at) = ?)
                      AND (? IS NULL OR strftime('%m', f.created_at) = ?)) AS total_vendido",
            [$anio, $anio, $mes, $mes])
        ->orderByDesc('total_vendido')
        ->orderBy('id')
        ->get()
        ->filter(fn ($p) => $p->total_vendido > 0);

    $total = $vendidos->count();

    $ultimaPagina = $total <= $this->primeraPagina
        ? 1
        : 1 + (int) ceil(($total - $this->primeraPagina) / $this->porPagina);

    $this->pagina = min(max($this->pagina, 1), $ultimaPagina);

    $offset = $this->pagina === 1
        ? 0
        : $this->primeraPagina + ($this->pagina - 2) * $this->porPagina;

    $limite = $this->pagina === 1 ? $this->primeraPagina : $this->porPagina;

    $masVendidos = $vendidos->slice($offset, $limite)->values();

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