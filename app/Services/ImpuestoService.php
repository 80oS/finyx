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

    public function crear()
    {
         return $this->impuesto_repository->crear($datos);
    }
}