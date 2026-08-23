<?php
namespace App\Repositories;

use App\Models\categoria;

class CategoriaRepository{

    public function index()
    {
        return categoria::all();
    }
}
?>