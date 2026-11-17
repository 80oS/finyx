<?php 
namespace App\Services;

use App\Repositories\RolRepository;
use Spatie\Permission\Models\Role;

class RolService{
    private RolRepository $rol_repository;

    public function __construct(RolRepository $rol_repository)
    {
        $this->rol_repository = $rol_repository;
    }

    public function index()
    {
        return $this->rol_repository->index();
    }

    public function crear(array $datos)
    {
        return $this->rol_repository->crear($datos);
    }

    public function buscarId(int $id)
    {
        return $this->rol_repository->buscarId($id);
    }

    public function asignarPermisos(int $id, array $permisos)
    {
        return $this->rol_repository->asignarPermisos($id, $permisos);
    }

    public function anularPermisos(int $id, array $permisos)
    {
        return $this->rol_repository->anularPermisos($id, $permisos);
    }
}
?>