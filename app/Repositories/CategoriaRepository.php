<?php
namespace App\Repositories;

use App\Models\categoria;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CategoriaRepository{

    public function index()
    {
        return categoria::all();
    }

    public function productos(categoria $categoria)
    {        
        return $categoria->producto()
            ->select('id', 'nombre')
            ->get()
            ->map(fn($producto) => [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
            ]);
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

    public function changeState(int $id)
    {
        return DB::transaction(function () use ($id) {

            $categoria = Categoria::findOrFail($id);

            $nuevoEstado = !$categoria->estado;

            $categoria->estado = $nuevoEstado;
            $categoria->save();

            // Actualizar el estado de los productos asociados
            Producto::where('id_categoria', $categoria->id)
                ->update([
                    'estado' => $nuevoEstado
                ]);

            return $nuevoEstado
                ? 'Categoría habilitada exitosamente.'
                : 'Categoría deshabilitada exitosamente.';
        });
    }
}
?>