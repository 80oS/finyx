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
        return cliente::create($datos);
    }

    public function buscarId(int $id)
    {
        return cliente::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $cliente = cliente::findOrFail($id);
        $cliente->update($datos);
    }

    public function destroy(int $id)
    {
        cliente::destroy($id);
    }
}
?>