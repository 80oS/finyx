<?php
namespace App\Services;

use App\Models\Ubicacion;
use App\Repositories\Interfaces\UbicacionRepositoryInterface;
use App\Repositories\UbicacionRepository;
use DomainException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UbicacionService{
    private UbicacionRepository $ubicacion_repository;

    public function __construct(UbicacionRepository $ubicacion_repository)
    {
        $this->ubicacion_repository = $ubicacion_repository;
    }

    public function index()
    {
        return $this->ubicacion_repository->index();
    }

    public function ubicacionPadre()
    {
        return $this->ubicacion_repository->ubicacionPadre();
    }

    public function store(array $datos)
    {
        return $this->ubicacion_repository->store($datos);
    }

    public function show(int $id)
    {
        return $this->ubicacion_repository->show($id);
    }

    public function buscarId(int $id)
    {
        return $this->ubicacion_repository->buscarId($id);
    }

    public function excluirIdUbicacion(int $id)
    {
        return $this->ubicacion_repository->excluirIdUbicacion($id);
    }

    public function update(int $id, array $datos)
    {
        return $this->ubicacion_repository->update($id, $datos);
    }

    public function changeState(int $id)
    {
        return $this->ubicacion_repository->changeState($id);
    }

    public function asignarProductosUbicacion(int $id, array $datos)
    {
        return $this->ubicacion_repository->asignarProductosUbicacion($id, $datos);
    }

    public function moverProductos(int $idOrigen, int $idDestino, array $productos): void
    {
        DB::transaction(function () use (
            $idOrigen,
            $idDestino,
            $productos
        ){
            $idsUbicaciones = [$idOrigen, $idDestino];
            sort($idsUbicaciones);

            $ubicaciones = Ubicacion::query()->whereIn('id', $idsUbicaciones)
            ->orderBy('id')->lockForUpdate()->get();

            if($ubicaciones->count() !== 2) {
                throw new DomainException(
                    'una de las ubicacioneas ya no esta disponible.'
                );
            }

            foreach ($productos as $producto) {
                $idProducto = (int) $producto['id_producto'];
                $cantidadMover = (int) $producto['cantidad'];

                $origen = $this->ubicacion_repository->bloquearAgignacion($idOrigen, $idProducto);

                if (!$origen || $origen->cantidad < $cantidadMover){
                    throw new DomainException("No hay suficientes unidades disponibles del producto {$idProducto}.");
                }

                $destino = $this->ubicacion_repository->bloquearOCrearDestino($idDestino, $idProducto);

                $origen->cantidad -= $cantidadMover;

                if($origen->cantidad === 0) {
                    $this->ubicacion_repository->eliminarAsignacion($origen);
                }else{
                    $this->ubicacion_repository->guardarAsignacion($origen);
                }

                $destino->cantidad += $cantidadMover;

                $this->ubicacion_repository->guardarAsignacion($destino);
            }
        }, 3);
    }
}
?>