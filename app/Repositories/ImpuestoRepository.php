<?php
namespace App\Repositories;

use App\Models\impuesto;

class ImpuestoRepository{

    public function index()
    {
        return Impuesto::all();
    }

    public function crear(array $datos)
    {
        Impuesto::create($datos);
    }

    public function buscarId(int $id)
    {
        return Impuesto::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $impuesto = Impuesto::findOrFail($id);
        $impuesto->update($datos);

        return $impuesto;
    }

    public function changeState(int $id)
    {
        $impuesto = impuesto::findOrFail($id);

        if($impuesto['estado'] == 1){
            $impuesto['estado'] = 0;
            $mensaje = 'impuesto inhabilitado correctamente';
        }else{
            $impuesto['estado'] = 1;
            $mensaje = 'impuesto habilitado correctamente';
        }

        $impuesto->save();

        return $mensaje;
    }

}