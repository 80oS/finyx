<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class AlertaStock extends Component
{
    public function render()
    {
        $productos = Producto::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();

        return view('livewire.alerta-stock', compact('productos'));
        
    }
}