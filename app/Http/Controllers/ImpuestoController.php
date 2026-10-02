<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImpuestoStoreRequest;
use App\Http\Requests\ImpuestoUpdateRequest;
use App\Services\ImpuestoService;

class ImpuestoController extends Controller
{
    private ImpuestoService $impuesto_service;

    public function __construct(ImpuestoService $impuesto_service)
    {
        $this->impuesto_service = $impuesto_service;
    }

    public function index()
    {
          $facturas = $this->venta_service->index();

        return view('factura.index', compact('facturas'));
    }

    public function create()
    {
        return view('impuesto.create');
    }

    public function store(ImpuestoStoreRequest $request)
    {
       $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        'porcentaje' => 'required|numeric|min:0|max:50',
    ]);

    $this->impuesto_service->crear($datos);

    return redirect()->route('venta.index')
        ->with('success', 'Impuesto creado correctamente.');
    }

    public function edit(int $id)
    {
        $impuesto = $this->impuesto_service->buscarId($id);

        return view('impuesto.edit', compact('impuesto'));
    }

    public function update(int $id, ImpuestoUpdateRequest $request)
    {
        $this->impuesto_service->update($id, $request->validated());

        return redirect()
            ->route('impuesto.index')
            ->with('success', 'Impuesto actualizado exitosamente');
    }

    public function destroy(int $id)
    {
       //
    }
}
