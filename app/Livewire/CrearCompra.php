<?php

namespace App\Livewire;

use App\Repositories\CompraRepository;
use App\Services\CompraService;
use Livewire\Component;

class CrearCompra extends Component
{
    public $id_proveedor;
    public $id_producto;
    public $cantidad = 1;
    public $precio_unitario = 0;

    public array $items = [];

    public function agregarItem(CompraRepository $repo)
    {
        $this->validate([
            'id_producto'     => 'required|exists:producto,id',
            'cantidad'        => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $this->items[] = [
            'id_producto' => (int) $this->id_producto,
            'nombre'      => $repo->nombreProducto((int) $this->id_producto),
            'cantidad'    => (int) $this->cantidad,
            'precio'      => (float) $this->precio_unitario,
        ];

        $this->reset(['id_producto', 'cantidad', 'precio_unitario']);
    }

    public function quitarItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function guardar(CompraService $service)
    {
        $this->validate([
            'id_proveedor' => 'required|exists:proveedor,id',
            'items'        => 'required|array|min:1',
        ]);

        $service->registrar((int) $this->id_proveedor, $this->items);

        $this->reset();
        session()->flash('ok', 'Compra registrada y stock actualizado.');
    }

    public function render(CompraRepository $repo)
    {
        return view('livewire.crear-compra', [
            'proveedores' => $repo->proveedores(),
            'productos'   => $repo->productos(),
        ]);
    }
}