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

    public function changeState(int $id)
    {
        $producto = producto::findOrFail($id);

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