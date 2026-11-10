<?php

namespace App\Livewire;

use App\Models\Ubicacion;
use Livewire\Component;

class ModalUbicacionesHijas extends Component
{
    public bool $modalAbierto = false;

    public int $ubicacionId;

    public function mount(int $ubicacionId): void
    {
        $this->ubicacionId = $ubicacionId;
    }

    public function abrirModal()
    {
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }
    
    public function render()
    {
        $ubicacion = Ubicacion::query()->where('id', $this->ubicacionId)->with('hijo')->firstOrFail();

        return view('livewire.modal-ubicaciones-hijas', compact('ubicacion'));
    }
}
