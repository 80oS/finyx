<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;

class FacturaProduct extends Component
{
    use WithPagination;

    public string $barcode = '';
    public string $nombre= '';
    public string $cantidad = '1';

    public ?int $productoSeleccionado = null;

    public array $productos = [];
    public array $sugerencias = [];

    public int $porPagina = 5;
    public int $paginaActual = 1;

    public function eliminarProducto(int $index): void
    {
        unset($this->productos[$index]);
        $this->productos = array_values($this->productos); // reindexar

        $totalPaginas = max(
            1,
            (int) ceil(count($this->productos) / $this->porPagina)
        );

        $this->paginaActual = min($this->paginaActual, $totalPaginas);

        $this->dispatch(
            'factura-actualizada',
            totalImpuestos: $this->totalImpuestos(),
            subtotal: $this->subtotal(),
            total: $this->total(),
            cantidad: $this->contarProductos()
        );
    }

    public function buscarPorBarcode(): void
    {
        if (empty(trim($this->barcode))) {
            return;
        }

        $producto = Producto::where('barcode', trim($this->barcode))
            ->where('estado', true)
            ->first();

        if (!$producto) {
            $this->addError('barcode', 'Producto no encontrado.');

            return;
        }

        $this->resetErrorBag('barcode');

        $this->seleccionarProducto($producto);
    }

    public function updatedNombre(): void
    {
        $nombre = trim($this->nombre);

        // Si se está escribiendo nuevamente,
        // quitar el producto seleccionado anteriormente.
        $this->productoSeleccionado = null;

        if (strlen($nombre) < 2) {
            $this->sugerencias = [];

            return;
        }

        $this->sugerencias = Producto::query()
            ->where('nombre', 'like', '%' . $nombre . '%')
            ->where('estado', true)
            ->limit(3)
            ->get([
                'id',
                'codigo',
                'barcode',
                'nombre',
                'precio_unitario',
                'stock',
            ])
            ->toArray();
    }

    public function seleccionarProducto(Producto $producto): void
    {
        $this->productoSeleccionado = $producto->id;

        // Mostrar el nombre del producto seleccionado
        $this->nombre = $producto->nombre;

        // Mostrar también el código de barras si existe
        $this->barcode = $producto->barcode ?? '';

        // Cantidad inicial
        $this->cantidad = '1';

        // Ocultar sugerencias
        $this->sugerencias = [];

        $this->resetErrorBag();

        // Enfocar cantidad
        $this->dispatch('focus-cantidad');
    }

    public function agregarProducto(): void
    {
        if (!$this->productoSeleccionado) {
            $this->addError(
                'producto',
                'Primero debes seleccionar un producto.'
            );

            return;
        }

        $producto = Producto::find($this->productoSeleccionado);

        if (!$producto) {
            $this->addError(
                'producto',
                'El producto no existe.'
            );

            return;
        }

        $cantidad = (float) $this->cantidad;

        if ($cantidad <= 0) {
            $this->addError(
                'cantidad',
                'La cantidad debe ser mayor que cero.'
            );

            return;
        }

        // Verificar stock
        if ($cantidad > $producto->stock) {
            $this->addError(
                'cantidad',
                'La cantidad supera el stock disponible.'
            );

            return;
        }

        $this->resetErrorBag();

        // Buscar si ya está en la factura
        $index = collect($this->productos)
            ->search(
                fn($p) => $p['id_producto'] == $producto->id
            );

        if ($index !== false) {

            $nuevaCantidad =
                (float) $this->productos[$index]['cantidad']
                + $cantidad;

            if ($nuevaCantidad > $producto->stock) {
                $this->addError(
                    'cantidad',
                    'La cantidad total supera el stock disponible.'
                );

                return;
            }

            $this->productos[$index]['cantidad'] = $nuevaCantidad;

            $this->calcularSubtotal($index);
        } else {

            $this->productos[] = [
                'id_producto' => $producto->id,
                'codigo' => $producto->codigo,
                'nombre' => $producto->nombre,
                'precio_unitario' => $producto->precio_unitario,
                'cantidad' => $cantidad,
                'subtotal' => 0,
                'total' => 0,
            ];
        }

        $index = array_key_last($this->productos);
        $this->actualizarTotalesProducto($index);

        $this->dispatch(
            'factura-actualizada',
            subtotal: $this->subtotal(),
            totalImpuestos: $this->totalImpuestos(),
            total: $this->total(),
            cantidad: $this->contarProductos()
        );

        // Limpiar formulario
        $this->limpiarProducto();
    }

    private function limpiarProducto(): void
    {
        $this->barcode = '';
        $this->nombre = '';
        $this->cantidad = '1';
        $this->productoSeleccionado = null;
        $this->sugerencias = [];

        $this->dispatch('focus-barcode');
    }


    public function calcularSubtotal(int $index): void
    {
        $this->actualizarTotalesProducto($index);
    }

    public function total(): float
    {
        return round(
            collect($this->productos)->sum(
                fn($p) => (float) $p['total']
            ),
            2
        );
    }

    public function contarProductos(): int
    {
        return count($this->productos);
    }

    public function cambiarPagina(int $pagina): void
    {
        $totalProductos = count($this->productos);
        $totalPaginas = max(1, (int) ceil($totalProductos / $this->porPagina));

        $this->paginaActual = max(1, min($pagina, $totalPaginas));
    }

    public function productosPaginados(): LengthAwarePaginator
    {
        $productos = collect($this->productos);

        $total = $productos->count();

        $elementos = $productos
            ->slice(($this->paginaActual - 1) * $this->porPagina, $this->porPagina)->values();
        
        return new LengthAwarePaginator(
            $elementos,
            $total,
            $this->porPagina,
            $this->paginaActual,
            [
                'path' => request()->url(),
                'pageName' => 'paginaProductos',
            ]
        );
    }

    public function subtotal(): float
    {
        return round(
            collect($this->productos)->sum(
                fn($p) => (float) $p['subtotal']
            ),
            2
        );
    }

    public function totalImpuestos(): float
    {
        return round(
            collect($this->productos)->sum(
                fn($p) => (float) $p['total'] - (float) $p['subtotal']
            ),
            2
        );
    }

    private function actualizarTotalesProducto(int $index): void
    {
        $producto = Producto::findOrFail(
            $this->productos[$index]['id_producto']
        );

        $cantidad = (float) $this->productos[$index]['cantidad'];

        $resultado = app(\App\Services\CalculoImpuestosService::class)
            ->calcularProducto($producto, $cantidad);

        $this->productos[$index]['subtotal'] = $resultado['subtotal'];
        $this->productos[$index]['total'] = $resultado['total'];
    }

    public function render()
    {
        return view('livewire.factura-product');
    }
}
