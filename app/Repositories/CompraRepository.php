<?php
namespace App\Repositories;

use App\Models\compra;

class CompraRepository{

    public function index()
    {
        return compra::with('proveedor')->get();
    }

    public function crear(array $datos)
    {
        compra::create($datos);
    }

    public function buscarId(int $id)
    {
        return compra::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $compras = compra::findOrFail($id);
        $compras->update($datos);
    }
}