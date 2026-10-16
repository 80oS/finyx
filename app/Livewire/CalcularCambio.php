<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class CalcularCambio extends Component
{
    #[Reactive]
    public float $totalFactura = 0;

    public string $metodoPago = 'tarjeta';

    public $montoRecibido = '';

    public function getCambioProperty(): float
    {
        return max(
            0, (float) $this->montoRecibido - (float) $this->totalFactura
        );
    }

    public function getFaltanteProperty(): float
    {
        return max(
            0, (float) $this->totalFactura - (float) $this->montoRecibido
        );
    }
    
    public function render()
    {
        return view('livewire.calcular-cambio');
    }
}
