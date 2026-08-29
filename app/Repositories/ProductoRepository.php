<?php
namespace App\Repositories;

use App\Models\producto;

class ProductoRepository{

    public function index()
    {
        return producto::with('categoria')->get();
    }
}
?>