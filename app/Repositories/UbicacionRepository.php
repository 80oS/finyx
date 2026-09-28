<?php
namespace App\Repositories;

use App\Models\Ubicacion;

class UbicacionRepository{

    public function index()
    {
        return Ubicacion::all();
    }
}
?>