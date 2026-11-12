<?php
namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RolRepository{
    public function obtenerTodos()
    {
        return Role::with('permissions')->orderBy('name')->get();
    }

    public function buscarId(int $id)
    {
        return Role::with('permissions')->findOrFail($id);
    }

    public function crear(array $datos)
    {
        return Role::create([
            'name' => $datos['name'],
            'guard_name' => 'web'
        ]);
    }

    public function update(int $id, array $datos)
    {
        $role = Role::findOrFail($id);
        $role->update([
            'name' => $datos['name']
        ]);

        return $role;
    }

    public function eliminar(int $id)
    {
        return Role::destroy($id);
    }

    public function asignarPermisos(int $id, array $permisos)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions($permisos);

        return $role->load('permissions');
    }
}
?>