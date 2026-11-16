<?php

namespace App\Livewire;

use App\Models\categoria;
use App\Models\Producto;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ProductosCategoria extends Component
{
    public $categoriaId = '';

    public int $impuestoId;

    public array $productosSeleccionados = [];

    public function mount(int $impuestoId)
    {
        $this->impuestoId = $impuestoId;
    }

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

        $impuestoId = $this->impuestoId;

        $productos = collect();

        if(!empty($this->categoriaId)) {
            $productos = Producto::where('id_categoria', $this->categoriaId)
                ->whereDoesntHave('productoImpuesto', function ($query) use ($impuestoId) {
                    $query->where('id_impuesto', $impuestoId);
                })
                ->with('categoria')
                ->orderBy('nombre')->get();
        }

        return view('livewire.productos-categoria', [
            'categorias' => $categorias,
            'productos' => $productos
        ]);
    }
}
