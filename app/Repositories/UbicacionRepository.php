<?php
namespace App\Repositories;

use App\Models\Producto;
use App\Models\ProductoUbicacion;
use App\Models\Ubicacion;
use Illuminate\Database\Eloquent\Collection;

class UbicacionRepository{

    public function index()
    {
        return Ubicacion::query()->with('padre')
        ->withCount('ProductoUbicacion')->orderBy('nombre')->get();
    }

    public function ubicacionPadre()
    {
        return Ubicacion::whereNull('id_ubicacion_padre')->where('estado', 'activa')->orderBy('nombre')->get();
    }

    public function store(array $datos)
    {
        Ubicacion::create($datos);
    }

    public function show(int $id)
    {
        return Ubicacion::query()->where('id', $id)->with(['padre', 'hijo'])
            ->withCount(['ProductoUbicacion as productosDistintos'])
            ->withSum('ProductoUbicacion as unidadesAlmacenadas', 'cantidad')->firstOrFail();
    }

    public function buscarId(int $id)
    {
        return Ubicacion::findOrFail($id);
    }

    public function excluirIdUbicacion(int $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);

        $idsExcluir = [$ubicacion->id];
        $padres = [$ubicacion->id];

        while (!empty($padres)) {
            $hijos = Ubicacion::whereIn('id_ubicacion_padre', $padres)->pluck('id')->all();

            $hijos = array_diff($hijos, $idsExcluir);

            $idsExcluir = array_merge($idsExcluir, $hijos);
            $padres = $hijos;
        }

        return Ubicacion::whereNotIn('id', $idsExcluir)->where('estado', 'activa')->orderBy('nombre')->get();
    }

    public function update(int $id, array $datos)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        $ubicacion->update($datos);
    }

    public function changeState(int $id)
    {
        $ubicacion = Ubicacion::findOrFail($id);
        
        if($ubicacion->estado == 'activa'){
            $ubicacion->estado = 'inactiva';
            $mensaje = 'ubicacion desabilitada con exito';
        }else{
            $ubicacion->estado = 'activa';
            $mensaje = 'ubicacion habilitada con exito';
        }

        $ubicacion->save();

        return $mensaje;
    }

    public function asignarProductosUbicacion(int $id, array $datos)
    {
        $productos = $datos['productos'];

        unset($datos['productos']);

        $ubicacion = Ubicacion::findOrFail($id);

        foreach($productos as $datoProducto){
            $ubica = $ubicacion->ProductoUbicacion()
            ->where('id_producto', $datoProducto['id_producto'])->first();

            if($ubica){
                $ubica->cantidad += $datoProducto['cantidad'];
                $ubica->save();
            }else{
                $ubicacion->ProductoUbicacion()->create([
                    'id_producto' => $datoProducto['id_producto'],
                    'cantidad' => $datoProducto['cantidad'],
                ]);
            }
        }
        return $ubicacion;
    }

    public function obtenerAsignacionParaMover(int $idUbicacion): Collection
    {
        return ProductoUbicacion::query()->where('id_ubicacion', $idUbicacion)
        ->with('producto')->orderBy('id_producto')->get();
    }

    public function bloquearAgignacion(int $idUbicacion, int $idProducto): ?ProductoUbicacion
    {
        return ProductoUbicacion::query()->where('id_ubicacion', $idUbicacion)
        ->where('id_producto', $idProducto)->lockForUpdate()->first();
    }

    public function bloquearOCrearDestino(int $idUbicacion, int $idProducto): ProductoUbicacion
    {
        $asigacion = ProductoUbicacion::query()->where('id_ubicacion', $idUbicacion)
        ->where('id_producto', $idProducto)->lockForUpdate()->first();

        if($asigacion){
            return $asigacion;
        }

        $asigacion = new ProductoUbicacion();

        $asigacion->id_ubicacion = $idUbicacion;
        $asigacion->id_producto = $idProducto;
        $asigacion->cantidad = 0;

        return $asigacion;
    }

    public function guardarAsignacion(ProductoUbicacion $asigacion): void
    {
        $asigacion->save();
    }

    public function eliminarAsignacion(ProductoUbicacion $asigacion): void
    {
        $asigacion->delete();
    }
}
?>