<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\Ubicacion;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AsignarProductosUbicacion extends Component
{
    #[Locked]
    public int $ubicacionId;

    public bool $modalAbierto = false;

    public string $buscar = '';

    public array $cantidades = [];

    public array $productosSeleccionados = [];

    public function mount(int $ubicacionId): void
    {
        Ubicacion::findOrFail($ubicacionId);

        $this->ubicacionId = $ubicacionId;
    }

    public function abrirModal(): void
    {
        $this->resetValidation();
        $this->modalAbierto = true;
    }

    public function cerrarModal(): void
    {
        $this->modalAbierto = false;
        $this->buscar = '';
        $this->productosSeleccionados = [];
        $this->resetValidation();
    }

    public function aumentar(int $productoId): void
    {
        if (isset($this->productosSeleccionados[$productoId])) {
            $this->productosSeleccionados[$productoId]++;
        }
    }

    public function disminuir(int $productoId): void
    {
        if (isset($this->productosSeleccionados[$productoId])) {
            $this->productosSeleccionados[$productoId] = max(
                1,
                $this->productosSeleccionados[$productoId] - 1
            );
        }
    }


    public function agregarProducto(int $productoId): void
    {
        Producto::findOrFail($productoId);

        $this->productosSeleccionados[$productoId] ??= 1;
    }

    public function quitarProducto(int $productoId): void
    {
        unset($this->productosSeleccionados[$productoId]);
    }

    public function render()
    {
        $productos = Producto::query()
            ->when(trim($this->buscar) !== '', function ($query) {
                $termino = trim($this->buscar);

                $query->where(function ($subquery) use ($termino) {
                    $subquery->where('nombre', 'like', "%{$termino}%")
                        ->orWhere('codigo', 'like', "%{$termino}%")
                        ->orWhere('barcode', 'like', "%{$termino}%");
                });
            })
            ->orderBy('nombre')
            ->limit(20)
            ->get();

        $seleccionados = empty($this->productosSeleccionados)
            ? collect()
            : Producto::whereIn(
                'id',
                array_keys($this->productosSeleccionados)
            )->orderBy('nombre')->get();
        
        return view('livewire.asignar-productos-ubicacion', compact('productos','seleccionados'));
    }
}
