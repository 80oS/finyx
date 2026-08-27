<?php

namespace App\Services;

use App\Repositories\ProveedorRepository;

class ProveedorService
{
    private ProveedorRepository $proveedor_repository;

    public function __construct(ProveedorRepository $proveedor_repository)
    {
        $this->proveedor_repository = $proveedor_repository;
    }

    public function index()
    {
        return $this->proveedor_repository->index();
    }

    public function crear($datos)
    {
        return $this->proveedor_repository->crear($datos);
    }

    public function buscarId($id)
    {
        return $this->proveedor_repository->buscarId($id);
    }

    public function update($id, $datos)
    {
        return $this->proveedor_repository->update($id, $datos);
    }

    public function destroy($id)
    {
        return $this->proveedor_repository->destroy($id);
    }
}