<?php

namespace App\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductoMasVendido extends Component
{
    public int $pagina = 1;

    protected int $primeraPagina = 3;
    protected int $porPagina = 3;

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
        // Se cuenta aparte, sin la subconsulta ni el orden
        $total = Producto::count();

        $ultimaPagina = $total <= $this->primeraPagina
            ? 1
            : 1 + (int) ceil(($total - $this->primeraPagina) / $this->porPagina);

        // Si la página pedida no existe, se ajusta al rango válido
        $this->pagina = min(max($this->pagina, 1), $ultimaPagina);

        $offset = $this->pagina === 1
            ? 0
            : $this->primeraPagina + ($this->pagina - 2) * $this->porPagina;

        $limite = $this->pagina === 1 ? $this->primeraPagina : $this->porPagina;

        $totalVendido = DB::table('detalle_factura')
            ->selectRaw('SUM(cantidad)')
            ->whereColumn('detalle_factura.id_producto', 'producto.id');

        $masVendidos = Producto::select('id', 'nombre', 'codigo')
            ->selectSub($totalVendido, 'total_vendido')
            ->orderByDesc('total_vendido')
            ->orderBy('id') // desempate: así los productos no se repiten entre páginas
            ->offset($offset)
            ->limit($limite)
            ->get();

        return view('livewire.producto-mas-vendido', [
            'masVendidos'  => $masVendidos,
            'total'        => $total,
            'ultimaPagina' => $ultimaPagina,
            'desde'        => $offset + 1,
        ]);
    }
}