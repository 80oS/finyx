<?php
namespace App\Repositories;

use App\Models\Producto;

class ProductoRepository{

    public function index($estado = null)
    {
        $query = Producto::with('categoria');

        if ($estado !== null && $estado !== '') {
            $query->where('estado', (int) $estado);
        }

        return $query->get();
    }

    public function crear(array $datos)
    {
        Producto::create($datos);
    }

    public function buscarId(int $id)
    {
        return Producto::findOrFail($id);
    }

    public function actualizar(int $id, array $datos)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($datos);
    }

    public function changeState(int $id)
    {
        $producto = Producto::findOrFail($id);

        if($producto->estado == 1){
            $producto->estado = 0;
            $mensaje = 'Producto desabilitado con exito';
        }else{
            $producto->estado = 1;
            $mensaje = 'Producto habilitado con exito';
        }
        $producto->save();

        return $mensaje;
    }
}
?>