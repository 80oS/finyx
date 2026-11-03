<?php
namespace App\Repositories\Interfaces;

use App\Models\ProductoUbicacion;
use Illuminate\Database\Eloquent\Collection;

interface UbicacionRepositoryInterface{

    public function obtenerAsignacionParaMover(
        int $idUbicacion
    ): collection;

    public function bloquearAgignacion(
        int $idUbicacion,
        int $idProduccto
    ): ?ProductoUbicacion;

    public function bloquearOCrearDestino(
        int $idUbicacion,
        int $idProduccto
    ): ProductoUbicacion;

    public function guardarAsignacion(
        ProductoUbicacion $asignacion
    ): void;

    public function eliminarAsignacion(
        ProductoUbicacion $asignacion
    ): void;

}
?>