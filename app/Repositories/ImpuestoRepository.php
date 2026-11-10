<?php
namespace App\Repositories;

use App\Models\categoria;
use App\Models\impuesto;
use App\Models\Producto;

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

    public function impuestoProducto(int $id)
    {
        $impuesto = impuesto::findOrFail($id);

        return Producto::WhereDoesntHave('productoImpuesto',
            function ($query) use ($impuesto){
                $query->where('id_impuesto', $impuesto->id);
            }
        )->orderBy('nombre')->get();
    }

    public function asignarImpuestoProducto(int $id, array $datos)
    {
        $productos = $datos['productos'];

        unset($datos['productos']);

        $impuesto = impuesto::findOrFail($id);

        foreach($productos as $datoProducto){
            $impuesto->productoImpuesto()->create([
                'id_producto' => $datoProducto['id_producto'],
                'tarifa_aplicada' => $impuesto->porcentaje,
                'fecha_inicio' => $impuesto->fecha_inicio,
                'fecha_fin' => $impuesto->fecha_fin,
                'estado' => $datos['estado']
            ]);
        }

        return $impuesto;

    }

}