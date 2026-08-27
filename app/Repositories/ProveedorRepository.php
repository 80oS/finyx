<?php

namespace App\Repositories;

use App\Models\Proveedor;

class ProveedorRepository
{
    public function index()
    {
        return Proveedor::all();
    }

    public function crear($datos)
    {
        return Proveedor::create($datos);
    }

    public function buscarId($id)
    {
        return Proveedor::findOrFail($id);
    }

    public function update($id, $datos)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update($datos);

        return $proveedor;
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return true;
    }
}