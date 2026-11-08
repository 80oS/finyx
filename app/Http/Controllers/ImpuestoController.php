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
        $impuestos = $this->impuesto_service->index();

        return view('impuesto.index', compact('impuestos'));
    }

    public function create()
    {
        return view('impuesto.create');
    }

    public function store(ImpuestoStoreRequest $request)
    {
        $this->impuesto_service->crear($request->validated());

        return redirect()->route('impuesto.index')->with('success', 'impuesto creado correctamente');
    }

    public function edit(int $id)
    {
        $impuesto = $this->impuesto_service->buscarId($id);

        return view('impuesto.edit', compact('impuesto'));
    }

    public function update(int $id, ImpuestoUpdateRequest $request)
    {
        $this->impuesto_service->update($id, $request->validated());

        return redirect()->route('impuesto.index')->with('success', 'impuesto actualizado con exito');
    }

    public function changeState(int $id)
    {
        $mensaje = $this->impuesto_service->changeState($id);

        return redirect()->route('impuesto.index')->with('success', $mensaje);
    }
}
