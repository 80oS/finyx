<?php
namespace App\Services;

use App\Repositories\Interfaces\UbicacionRepositoryInterface;
use App\Repositories\UbicacionRepository;
use Illuminate\Validation\ValidationException;

class UbicacionService{
    private UbicacionRepository $ubicacion_repository;
    private UbicacionRepositoryInterface $ubicacion_repository_interface;

    public function __construct(UbicacionRepository $ubicacion_repository, UbicacionRepositoryInterface $ubicacion_repository_interface)
    {
        $this->ubicacion_repository = $ubicacion_repository;
        $this->ubicacion_repository_interface = $ubicacion_repository_interface;
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
        if ($idOrigen == $idDestino){
            throw ValidationException::withMessages([
                'idDestino' => 'La ubicación de destino debe ser diferente de la de origen.'
            ]);
        }
    }
}
?>