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
}
?>