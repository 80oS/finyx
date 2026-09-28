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
}
?>