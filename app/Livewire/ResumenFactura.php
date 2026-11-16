<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ResumenFactura extends Component
{
    public float $subtotal = 0;
    public float $total = 0;
    public int $cantidad = 0;
    public float $totalImpuestos = 0;

    #[On('factura-actualizada')]

    public function actualizarFactura(float $total, int $cantidad, float $subtotal, float $totalImpuestos): void
    {
        $this->subtotal = (float) $subtotal;
        $this->total = (float) $total;
        $this->cantidad = (int) $cantidad;
        $this->totalImpuestos = (float)$totalImpuestos;
    }

    public function render()
    {
        return view('livewire.resumen-factura');
    }
}
