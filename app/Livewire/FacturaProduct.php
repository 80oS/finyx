<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class FacturaProduct extends Component
{
    public string $barcode = '';

    public array $productos = [];

    public function eliminarProducto(int $index): void
    {
        unset($this->productos[$index]);
        $this->productos = array_values($this->productos); // reindexar
    }


    public function total(): float
    {
        return collect($this->productos)->sum(
            fn($p) => (float) $p['subtotal']
        );
    }

    public function buscarProducto(): void
    {
        if (empty($this->barcode)) {
            return;
        }

        $producto = Producto::where('barcode', $this->barcode)->first();

        if (!$producto) {
            $this->addError('barcode', 'Producto no encontrado.');

            $this->barcode = '';

            $this->dispatch('focus-barcode');

            return;
        }

        $this->resetErrorBag('barcode');

        // Verificar si el producto ya está en la factura
        $index = collect($this->productos)
            ->search(fn($p) => $p['id_producto'] == $producto->id);

        if ($index !== false) {

            // Si ya existe, aumenta la cantidad
            $this->productos[$index]['cantidad']++;

            $this->calcularSubtotal($index);
        } else {

            // Si no existe, agregarlo
            $this->productos[] = [
                'id_producto' => $producto->id,
                'codigo' => $producto->codigo,
                'nombre' => $producto->nombre,
                'precio_unitario' => $producto->precio_unitario,
                'cantidad' => 1,
                'subtotal' => $producto->precio_unitario,
            ];
        }

        // Limpiar el código de barras
        $this->barcode = '';

        // Volver a enfocar el campo
        $this->dispatch('focus-barcode');
    }

    public function calcularSubtotal(int $index): void
    {
        $cantidad = (float) $this->productos[$index]['cantidad'];
        $precio_unitario = (float) $this->productos[$index]['precio_unitario'];

        $this->productos[$index]['subtotal'] = $cantidad * $precio_unitario;
    }

    public function render()
    {
        return view('livewire.factura-product');
    }
}
