<?php
namespace App\Repositories;

use App\Models\Compra;

class CompraRepository{

    public function index()
    {
        return Compra::with('proveedor')->get();
    }

    public function crear(array $datos)
    {
        Compra::create($datos);
    }

    public function buscarId(int $id)
    {
        return Compra::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $Compras = Compra::findOrFail($id);
        $Compras->update($datos);
    }
}