<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class TableProducts extends Component
{
    use WithPagination;

    public $porPagina = 10;

    public function updatedPorPagina()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.table-products', 
        ['productos' => Producto::paginate($this->porPagina)]
        );
    }
}
