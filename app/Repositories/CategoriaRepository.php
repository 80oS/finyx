<?php
namespace App\Repositories;

use App\Models\categoria;

class CategoriaRepository{

    public function index()
    {
        return categoria::all();
    }

    public function crear(array $datos)
    {
        categoria::create($datos);
    }

    public function buscarId(int $id)
    {
        return categoria::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $categoria = categoria::findOrFail($id);
        $categoria->update($datos);
    }

    public function destroy(int $id)
    {
        categoria::destroy($id);
    }
}
?>