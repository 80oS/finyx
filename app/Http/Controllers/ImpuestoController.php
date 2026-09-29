<?php

namespace App\Http\Controllers;

use App\Models\impuesto;
use App\Services\ImpuestoService;
use Illuminate\Http\Request;


class ImpuestoController extends Controller
{
    private ImpuestoService $impuesto_service;

    public function __construct(ImpuestoService $impuesto_service)
    {
        $this->impuesto_service = $impuesto_service;
    }

    public function index()
    {
        $impuesto = $this->impuesto_service->index();
        return view('impuesto.index', compact('impuesto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('impuesto.create');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(impuesto $impuesto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(impuesto $impuesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, impuesto $impuesto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(impuesto $impuesto)
    {
        //
    }
}
