<?php
namespace App\Repositories;

use App\Models\impuesto;

class ImpuestoRepository{

    public function index()
    {
        return Impuesto::all();
    }

    public function crear(array $datos)
    {
        Impuesto::create($datos);
    }

     public function buscarId(int $id)
    {
         return Impuesto::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $impuesto = Impuesto::findOrFail($id);
        $impuesto->update($datos);

        return $impuesto;
    }

    

}