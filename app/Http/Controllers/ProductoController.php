<?php

namespace App\Http\Controllers;

use App\Models\producto;
use App\Services\ProductoService;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private ProductoService $producto_service;

    public function __construct(ProductoService $producto_service)
    {
        $this->producto_service = $producto_service;
    }

    public function index()
    {
        $productos = $this->producto_service->index();

        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
