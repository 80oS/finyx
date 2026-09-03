<?php
namespace App\Services;

use App\Repositories\CompraRepository;

class CompraService{

    private CompraRepository $compra_repository;

    public function __construct(CompraRepository $compra_repository)
    {
        $this->compra_repository = $compra_repository;
    }

    public function index()
    {
        return $this->compra_repository->index();
    }

   
    public function crear(array $datos)
    {
        return $this->compra_repository->crear($datos);
    }

    
    public function buscarId(int $id)
    {
        return $this->compra_repository->buscarId($id);
    }


}