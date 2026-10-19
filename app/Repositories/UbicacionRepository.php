<?php
namespace App\Repositories;

use App\Models\Producto;
use App\Models\Ubicacion;

class UbicacionRepository{

    public function index()
    {
        return Ubicacion::query()->with('padre')
        ->withCount('ProductoUbicacion')->orderBy('nombre')->get();
    }

    public function show(int $id)
    {
        return Ubicacion::with(['padre', 'ProductoUbicacion.producto'])->findOrFail($id);
    }
}
?>