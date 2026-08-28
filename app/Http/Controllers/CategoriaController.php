<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaStoreRequest;
use App\Http\Requests\CategoriaUpdateRequest;
use App\Models\categoria;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private CategoriaService $categoria_service;

    public function __construct(CategoriaService $categoria_service)
    {
        $this->categoria_service = $categoria_service;
    }
    public function index()
    {
        $categorias = $this->categoria_service->index();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(CategoriaStoreRequest $request)
    {
        $this->categoria_service->crear($request->validated());

        return redirect()->route('categoria.index')->with('success', 'categoria creada correctamnete');
    }

    public function edit(int $id)
    {
        $categoria  = $this->categoria_service->buscarId($id);

        return view('categoria.edit', compact('categoria'));
    }

    public function update(int $id, CategoriaUpdateRequest $request)
    {
        $this->categoria_service->update($id, $request->validated());

        return redirect()->route('categoria.index')->with('success', 'categoria exitosamente actualizada');
    }

    public function destroy(int $id)
    {
        $this->categoria_service->destroy($id);
    }
}
