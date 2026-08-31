<?php
namespace App\Repositories;

use App\Models\producto;

class ProductoRepository{

    public function index()
    {
        return producto::with('categoria')->get();
    }

    public function crear(array $datos)
    {
        producto::create($datos);
    }

    public function buscarId(int $id)
    {
        return producto::findOrFail($id);
    }

    public function actualizar(int $id, array $datos)
    {
        $producto = producto::findOrFail($id);
        $producto->update($datos);
    }
}
?>