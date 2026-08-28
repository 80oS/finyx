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

    public function buscarId(int $id)
    {
        return $this->categoria_repository->buscarId($id);
    }

    public function update(int $id, array $datos)
    {
        return $this->categoria_repository->update($id, $datos);
    }

    public function destroy(int $id)
    {
        return $this->categoria_repository->destroy($id);
    }
}
?>