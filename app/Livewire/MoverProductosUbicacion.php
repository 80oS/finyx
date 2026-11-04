<?php

namespace App\Livewire;

use App\Http\Requests\MoverProductosUbicacionRequest;
use App\Models\Ubicacion;
use Livewire\Component;

class MoverProductosUbicacion extends Component
{
    public int $ubicacionId;

    public bool $mostrarModal = false;

    public function mount(int $ubicacionId): void
    {
        $this->ubicacionId = $ubicacionId;
    }

    public function abrirModal(): void
    {
        $this->mostrarModal = true;
    }

    public function cerrarModal(): void
    {
        $this->mostrarModal = false;
    }

    public function render()
    {
        $ubicacion = Ubicacion::findOrFail($this->ubicacionId);

        $asignaciones = $ubicacion->ProductoUbicacion()
            ->with('producto')->orderBy('id_producto')->get();
        
        $ubicacionesDestino = Ubicacion::query()->where('id', '!=', $this->ubicacionId )
            ->where('estado', 'activa')->orderBy('nombre')->get();

        return view('livewire.mover-productos-ubicacion',
            compact('ubicacion', 'asignaciones', 'ubicacionesDestino'));
    }
}
