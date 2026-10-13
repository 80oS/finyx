<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use App\Services\UbicacionService;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    private UbicacionService $ubicacion_service;

    public function __construct(UbicacionService $ubicacion_service)
    {
        $this->ubicacion_service = $ubicacion_service;
    }
    public function index()
    {
        $ubicaciones = $this->ubicacion_service->index();
        return view('ubicacion.index', compact('ubicaciones'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Ubicacion $ubicacion)
    {
        //
    }

    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
        //
    }

    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
