<?php

namespace App\Livewire;

use Livewire\Component;

class FacturaProduct extends Component
{
    public array $productos = [
        ['codigo' => '', 'nombre' => '', 'precio_unitario' => 0, 'cantidad' => 1, 'subtotal' => 0]
    ];
    
    public function agregarProducto(): void
    {
        $this->productos[] = [
        'codigo' => '', 
        'nombre' => '', 
        'precio_unitario' => 0, 
        'cantidad' => 1, 
        'subtotal' => 0];
    }

    public function eliminarProducto(int $index): void
    {
        unset($this->productos[$index]);
        $this->productos = array_values($this->productos); // reindexar
    }


    public function total(): float
    {
        return collect($this->productos)->sum(
            fn($p) => (float) $p['cantidad'] * (float) $p['precio']
        );
    }

    public function render()
    {
        return view('livewire.factura-product');
    }
}
