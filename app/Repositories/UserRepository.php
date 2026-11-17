<?php
namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository{
    public function index()
    {
        return User::with('roles')->get();
    }

    public function buscarId(int $id)
    {
        return User::findOrFail($id);
    }

    public function asignarRol(int $id, array $rol)
    {
        $usuario = User::findOrFail($id);

        if($rol == 'Desarrollador') {
            abort(403, 'no puedes asignar este rol');
        }

        $usuario->syncRoles($rol);

        return $usuario;
    }

    public function anularRol(int $id, int $rolId)
    {
        $user = User::findOrFail($id);
        $rol = Role::findOrFail($rolId);

        // Evitar que el usuario se quite un rol protegido
        if ($rol->name === 'Desarrollador') {
            abort(403, 'No se puede anular este rol.');
        }

        $user->removeRole($rol);

        return $user;
    }
}
?>