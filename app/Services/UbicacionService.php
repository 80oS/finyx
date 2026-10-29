<?php
namespace App\Services;

use App\Repositories\UbicacionRepository;

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
}
?>