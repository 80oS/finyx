<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class PermisosRole extends Component
{
    public bool $modal = false;

    public int $rolId;

    public function mount(int $rolId)
    {
        $this->rolId = $rolId;
    }

    public function cerrarModal(): void
    {
        $this->modal = false;
    }

    public function abrirModal(): void
    {
        $this->modal = true;
    }

    public function render()
    {
        $rolId = $this->rolId;

        $permisos = Role::with('permissions')->where('id', $rolId)->firstOrFail();

        return view('livewire.permisos-role', compact('permisos'));
    }
}
