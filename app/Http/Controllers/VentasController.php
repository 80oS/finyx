<?php

namespace App\Http\Controllers;

use App\Services\VentaService;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    private VentaService $venta_service;

    public function __construct(VentaService $venta_service)
    {
        $this->venta_service = $venta_service;
    }

    public function index()
    {
        $facturas = $this->venta_service->index();

        return view('factura.index', compact('facturas'));
    }

    public function show(int $id)
    {
        $factura = $this->venta_service->show($id);
        return view('factura.show', compact('factura'));
    }
}
