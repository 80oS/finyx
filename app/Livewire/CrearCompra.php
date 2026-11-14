<?php

namespace App\Livewire;

use App\Repositories\CompraRepository;
use App\Services\CompraService;
use Livewire\Component;

class CrearCompra extends Component
{
    public $id_proveedor = '';
    public $metodo_pago = '';
    public $descuento = 0;
    public array $lineas = [];
    public int $intentos = 0;

    protected $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'numeric'  => 'El campo :attribute debe ser un número.',
        'integer'  => 'El campo :attribute debe ser un número entero.',
        'min'      => 'El campo :attribute debe ser como mínimo :min.',
        'max'      => 'El campo :attribute no puede ser mayor a :max.',
        'in'       => 'El valor de :attribute no es válido.',
        'exists'   => 'El :attribute seleccionado no es válido.',
    ];

    protected $validationAttributes = [
        'id_proveedor'      => 'proveedor',
        'metodo_pago'       => 'método de pago',
        'descuento'         => 'descuento',
        'lineas.*.nombre'   => 'nombre del producto',
        'lineas.*.cantidad' => 'cantidad',
        'lineas.*.precio'   => 'precio',
        'lineas.*.iva'      => 'IVA',
    ];

    public function mount()
    {
        $this->lineas = [$this->lineaVacia()];
    }

    private function lineaVacia(): array
    {
        return ['nombre' => '', 'cantidad' => 1, 'precio' => 0, 'iva' => 0];
    }

    public function agregarLinea()
    {
        $this->lineas[] = $this->lineaVacia();
    }

    public function quitarLinea($i)
    {
        unset($this->lineas[$i]);
        $this->lineas = array_values($this->lineas);

        if (!$this->lineas) {
            $this->lineas = [$this->lineaVacia()];
        }
    }

    public function getTotalesProperty()
    {
        return app(CompraService::class)->calcularTotales($this->lineas, (float) ($this->descuento ?: 0));
    }

    public function getFilasProperty()
    {
        $service = app(CompraService::class);

        return collect($this->lineas)->map(fn ($l) => $service->calcularLinea($l))->all();
    }

    public function guardar(CompraService $service)
    {
        $this->intentos++;

        $this->validate([
            'id_proveedor'      => 'required|exists:proveedor,id',
            'metodo_pago'       => 'required|in:efectivo,tarjeta,transferencia',
            'lineas.*.nombre'   => 'required|string|max:255',
            'lineas.*.cantidad' => 'required|integer|min:1',
            'lineas.*.precio'   => 'required|numeric|min:0',
            'lineas.*.iva'      => 'required|numeric|min:0|max:100',
            'descuento'         => 'nullable|numeric|min:0',
        ]);

        $service->registrar(
            (int) $this->id_proveedor,
            $this->metodo_pago,
            $this->lineas,
            (float) ($this->descuento ?: 0)
        );

        return redirect()->route('compra.index')->with('success', 'Compra registrada correctamente');
    }

    public function render(CompraRepository $repo)
    {
        return view('livewire.crear-compra', [
            'proveedores' => $repo->proveedores(),
        ]);
    }
}