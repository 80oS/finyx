<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ResumenFactura extends Component
{
    public float $total = 0;
    public int $cantidad = 0;

    #[On('factura-actualizada')]

    public function actualizarFactura(float $total, int $cantidad): void
    {
        $this->total = (float) $total;
        $this->cantidad = (int) $cantidad;
    }

    public function render()
    {
        return view('livewire.resumen-factura');
    }
}
