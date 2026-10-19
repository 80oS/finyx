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
}
?>