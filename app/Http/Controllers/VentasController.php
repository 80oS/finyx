<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentaStoreRequest;
use App\Services\ClienteService;
use App\Services\ProductoService;
use App\Services\VentaService;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    private VentaService $venta_service;
    private ClienteService $cliente_service;
    private ProductoService $producto_service;

    public function __construct(VentaService $venta_service, 
        ClienteService $cliente_service, ProductoService $producto_service)
    {
        $this->venta_service = $venta_service;
        $this->cliente_service = $cliente_service;
        $this->producto_service = $producto_service;
    }

    public function index()
    {
        $facturas = $this->venta_service->index();

        return view('factura.index', compact('facturas'));
    }

    public function create()
    {
        $clientes = $this->cliente_service->index();
        $productos = $this->producto_service->index();
        return view('factura.create', compact('clientes', 'productos'));
    }

    public function store(VentaStoreRequest $request)
    {
        $this->venta_service->create($request->validated());

        return redirect()->route('venta.index')->with('venta creada con exito');
    }

    public function show(int $id)
    {
        $factura = $this->venta_service->show($id);
        return view('factura.show', compact('factura'));
    }
}
