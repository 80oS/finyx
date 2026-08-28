<?php
namespace App\Repositories;

use App\Models\cliente;

class ClienteRepository{

    public function index()
    {
        return cliente::all();
    }

   public function crear(array $datos)
    {
        
    }

    public function buscarId(int $id)
    {
        
    }

    public function update(int $id, array $datos)
    {
        
    }
}
?>