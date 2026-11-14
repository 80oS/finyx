<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use App\Models\Proveedor;
use App\Http\Requests\CompraUpdateRequest;

class CompraController extends Controller
{
    private CompraService $compra_service;

    public function __construct(CompraService $compra_service)
    {
        $this->compra_service = $compra_service;
    }

    public function index()
    {
        $compras = $this->compra_service->index();

        return view('compra.index', compact('compras'));
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $compra = $this->compra_service->buscarId($id);
        $proveedores = Proveedor::all();

        return view('compra.edit', compact('compra', 'proveedores'));
    }

    public function create()
    {
        return view('compra.create');
    }
    
    public function update(int $id, CompraUpdateRequest $request)
    {
        $this->compra_service->update($id, $request->validated());

        return redirect()->route('compra.index')->with('success', 'compra actualizada correctamente');
    }

    public function destroy()
    {
        //
    }
}