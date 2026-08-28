<?php

namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService
{
    private ClienteRepository $cliente_repository;

    public function __construct(ClienteRepository $cliente_repository)
    {
        $this->cliente_repository = $cliente_repository;
    }

    public function index()
    {
        return $this->cliente_repository->index();
    }

    public function crear($datos)
    {
       return $this->cliente_repository->crear($datos);
    }

    public function buscarId($id)
    {
         return $this->cliente_repository->buscarId($id);
    }

    public function update($id, $datos)
    {
         return $this->cliente_repository->update($id, $datos);
    }

    public function destroy($id)
    {
        
    }
}