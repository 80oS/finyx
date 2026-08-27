<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorStoreRequest;
use App\Http\Requests\ProveedorUpdateRequest;
use App\Models\Proveedor;
use App\Services\ProveedorService;

class ProveedorController extends Controller
{
    private ProveedorService $proveedor_service;

    public function __construct(ProveedorService $proveedor_service)
    {
        $this->proveedor_service = $proveedor_service;
    }

    public function index()
    {
        $proveedores = $this->proveedor_service->index();

        return view('proveedor.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedor.create');
    }

    public function store(ProveedorStoreRequest $request)
    {
        $this->proveedor_service->crear($request->validated());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente');
    }

    public function edit(int $id)
    {
        $proveedor = $this->proveedor_service->buscarId($id);

        return view('proveedor.edit', compact('proveedor'));
    }

    public function update(int $id, ProveedorUpdateRequest $request)
    {
        $this->proveedor_service->update($id, $request->validated());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor actualizado exitosamente');
    }

    public function destroy($proveedor)
{
    $this->proveedor_service->destroy($proveedor);

    return redirect()->route('proveedores.index')
        ->with('success', 'Proveedor eliminado correctamente');
}
}