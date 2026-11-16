<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository{
    public function index()
    {
        return User::with('roles')->get();
    }

    public function buscarId(int $id)
    {
        return User::findOrFail($id);
    }

    public function asignarRol(int $id, string $rol)
    {
        $usuario = User::findOrFail($id);

        if($rol == 'Desarrollador') {
            abort(403, 'no puedes asignar este rol');
        }

        $usuario->syncRoles([$rol]);

        return $usuario;
    }
}
?>