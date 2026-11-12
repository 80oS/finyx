<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository{
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