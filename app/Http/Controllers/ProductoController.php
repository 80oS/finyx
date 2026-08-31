<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoStoreRequest;
use App\Models\producto;
use App\Services\CategoriaService;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private ProductoService $producto_service;
    private CategoriaService $categoria_service;

    public function __construct(ProductoService $producto_service, CategoriaService $categoria_service)
    {
        $this->producto_service = $producto_service;
        $this->categoria_service = $categoria_service;
    }

    public function index()
    {
        $productos = $this->producto_service->index();

        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $categorias = $this->categoria_service->index();

        return view('producto.create', compact('categorias'));
    }

    public function store(ProductoStoreRequest $request)
    {
        $this->producto_service->crear($request->validated());

        return redirect()->route('producto.index')->with('success', 'Producto creado con exito');
    }

    public function show(producto $producto)
    {
        //
    }

    public function edit(producto $producto)
    {
        //
    }

    public function update(Request $request, producto $producto)
    {
        //
    }

    public function destroy(producto $producto)
    {
        //
    }
}
