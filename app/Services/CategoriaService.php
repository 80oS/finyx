<?php
namespace App\Services;

use App\Repositories\CategoriaRepository;

class CategoriaService{

    private CategoriaRepository $categoria_repository;

    public function __construct(CategoriaRepository $categoria_repository)
    {
        $this->categoria_repository = $categoria_repository;
    }

    public function index()
    {
        return $this->categoria_repository->index();
    }

    public function crear(array $datos)
    {
        return $this->categoria_repository->crear($datos);
    }
}
?>