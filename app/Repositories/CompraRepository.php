<?php
namespace App\Repositories;

use App\Models\compra;

class CompraRepository{

    public function index()
    {
        return compra::with('proveedor')->get();
    }

    
}