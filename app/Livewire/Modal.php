<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public bool $modalActivo = false;

    public string $observaciones = '';

    public function abrirModal()
    {
        $this->modalActivo = true;
    }

    public function cerrarModal()
    {
        $this->modalActivo = false;
    }

    public function agregarObservacion()
    {
        $this->modalActivo = false;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
