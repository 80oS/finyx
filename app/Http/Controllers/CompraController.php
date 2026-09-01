<?php

namespace App\Http\Controllers;

use App\Services\CompraService;

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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
