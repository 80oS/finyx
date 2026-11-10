<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class AlertaStock extends Component
{
    public int $pagina = 1;

    public string $filtro = '';
    public ?int $valor = null;

    protected int $primeraPagina = 3;
    protected int $porPagina = 3;

    public function updatedFiltro(): void
    {
        $this->pagina = 1;
    }

    public function updatedValor(): void
    {
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
        $consulta = Producto::query();

        match ($this->filtro) {
            'promedio' => $consulta->where('stock', '<', Producto::selectRaw('AVG(stock)')),
            'valor'    => $consulta->where('stock', '<=', $this->valor ?? 0),
            'agotados' => $consulta->where('stock', 0),
            'todos'    => null,
            default    => $consulta->where('stock', '<=', 5), // 'bajo'
        };

        $consulta->orderBy('stock');

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

        return view('livewire.alerta-stock', [
            'productos'    => $consulta->offset($offset)->limit($limite)->get(),
            'total'        => $total,
            'ultimaPagina' => $ultimaPagina,
        ]);
    }
}