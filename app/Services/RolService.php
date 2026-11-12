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

    public function obtenerRoles()
    {
        return $this->rol_repository->obtenerTodos();
    }

    public function crear(array $datos)
    {
        return $this->rol_repository->crear($datos);
    }

    public function buscarId(int $id)
    {
        return $this->rol_repository->buscarId($id);
    }

    public function uppdate(int $id, array $datos)
    {
        $rol = $this->rol_repository->buscarId($id);

        $this->validarRolProtegido($rol);

        return $this->rol_repository->update($id, $datos);
    }

    public function eliminar(int $id)
    {
        return $this->rol_repository->eliminar($id);
    }

    public function asignarPermisos(int $id, array $permisos)
    {
        $rol = $this->rol_repository->buscarId($id);

        $this->validarRolProtegido($rol);

        return $this->asignarPermisos($id, $permisos);
    }

    private function validarRolProtegido(Role $rol): void
    {
        if($rol->name == 'Desarrollador'){
            abort(403, 'No puedes modificar el rol desarrollador');
        }
    }
}
?>