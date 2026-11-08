<?php
namespace App\Services;

use App\Repositories\ImpuestoRepository;

class ImpuestoService{

    private ImpuestoRepository $impuesto_repository;

    public function __construct(ImpuestoRepository $impuesto_repository)
    {
        $this->impuesto_repository = $impuesto_repository;
    }

    public function index()
    {
        return $this->impuesto_repository->index();
    }

    public function crear(array $datos)
    {
        return $this->impuesto_repository->crear($datos);
    }

    public function buscarId(int $id)
    {
        return $this->impuesto_repository->buscarId($id);
    }

    public function update(int $id, array $datos)
    {
        return $this->impuesto_repository->update($id, $datos);
    }

    public function changeState(int $id)
    {
        return $this->impuesto_repository->changeState($id);
    }
}