<?php

namespace App\Repositories;

use App\Models\Proveedor;

class ProveedorRepository
{
    public function index()
    {
        return Proveedor::all();
    }

    public function crear(array $datos)
    {
        return Proveedor::create($datos);
    }

    public function buscarId(int $id)
    {
        return Proveedor::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update($datos);

        return $proveedor;
    }

    public function destroy(int $id)
    {
        Proveedor::destroy($id);
    }
}