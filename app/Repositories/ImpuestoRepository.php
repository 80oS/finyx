<?php
namespace App\Repositories;

use App\Models\impuesto;

class ImpuestoRepository{

    public function index()
    {
        return impuesto::all();
    }

    public function crear(array $datos)
    {
        impuesto::create($datos);
    }
}