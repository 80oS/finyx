<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ProductoPorVencer extends Component
{
    public int $pagina = 1;

    protected int $primeraPagina = 3;
    protected int $porPagina = 3;
    protected int $diasAviso = 30;

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
        $consulta = Producto::whereNotNull('fecha_vencimiento')
            ->whereDate('fecha_vencimiento', '<=', now()->addDays($this->diasAviso))
            ->orderBy('fecha_vencimiento')
            ->orderBy('id');

        $total = (clone $consulta)->count();

        $ultimaPagina = $total <= $this->primeraPagina
            ? 1
            : 1 + (int) ceil(($total - $this->primeraPagina) / $this->porPagina);

        // Si la página pedida no existe, se ajusta al rango válido
        $this->pagina = min(max($this->pagina, 1), $ultimaPagina);

        $offset = $this->pagina === 1
            ? 0
            : $this->primeraPagina + ($this->pagina - 2) * $this->porPagina;

        $limite = $this->pagina === 1 ? $this->primeraPagina : $this->porPagina;

        return view('livewire.producto-por-vencer', [
            'productos'    => $consulta->offset($offset)->limit($limite)->get(),
            'total'        => $total,
            'ultimaPagina' => $ultimaPagina,
            'diasAviso'    => $this->diasAviso,
        ]);
    }
}