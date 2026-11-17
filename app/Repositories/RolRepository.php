<?php
namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RolRepository{
    public function index()
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

    public function asignarPermisos(int $id, array $permisos)
    {
        $role = Role::findOrFail($id);

        $role->givePermissionTo($permisos);

        return $role->load('permissions');
    }

    public function anularPermisos(int $id, array $permisos)
    {
        $rol = Role::findOrFail($id);

        if ($rol->name === 'Desarrollador') {
            abort(403, 'No se pueden anular los permisos de este rol.');
        }

        $permisosAsignados = $rol->permissions()
            ->whereIn('permissions.id', $permisos['permisos'])
            ->get();

        foreach ($permisosAsignados as $permiso) {
            $rol->revokePermissionTo($permiso);
        }

        app(\Spatie\Permission\PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
?>