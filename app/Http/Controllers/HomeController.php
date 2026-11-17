<?php

namespace App\Http\Controllers;

use App\Repositories\HomeRepository;
use App\Services\ProductoService;

class HomeController extends Controller
{
    private ProductoService $producto_service;

    public function __construct(ProductoService $producto_service)
    {
        $this->producto_service = $producto_service;
    }

    
    public function index(HomeRepository $repository)
    {
        return view('home', [
            'totalProductos' => $this->producto_service->totalProductos(),
            'totalUnidades' => $repository->totalUnidades(),
            'ventasCategoria' => $repository->ventasPorCategoria(),
            'totalFacturas' => $repository->totalFacturas(),
            'facturasRecientes' => $repository->facturasRecientes(),
            'ventasHoy' => $repository->ventasHoy(),
            'ventasPorDia' => $repository->ventasPorDia(),
        ]);
    }
}