<?php

namespace App\Livewire;

use App\Models\categoria;
use App\Models\Producto;
use Livewire\Component;

class ProductosCategoria extends Component
{
    public $categoriaId = '';

    public array $productosSeleccionados = [];

    public function updateCateagoriaId()
    {
        // Limpiar selección anterior.
        $this->productosSeleccionados = [];

        if (empty($value)) {
            return;
        }

        // Obtener los IDs de los productos de la categoría.
        $this->productosSeleccionados = Producto::where('id_categoria', $value)
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();
    }

    public function render()
    {
        $categorias = categoria::orderBy('nombre')->get();

        $productos = collect();

        if(!empty($this->categoriaId)) {
            $productos = Producto::where('id_categoria', $this->categoriaId)->with('categoria')
                ->orderBy('nombre')->get();
        }

        return view('livewire.productos-categoria', [
            'categorias' => $categorias,
            'productos' => $productos
        ]);
    }
}
