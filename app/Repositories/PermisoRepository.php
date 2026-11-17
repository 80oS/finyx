<?php
namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoRepository{

    public function index(int $id)
    {
        $rol = Role::findOrFail($id);

        $permisos = Permission::whereDoesntHave('roles', function ($query) use ($rol) {
            $query->where('roles.id', $rol->id);
        })
            ->orderBy('name')
            ->get();

        return $permisos->groupBy(function ($permiso) {

            $modulo = explode('.', $permiso->name)[0];

            return match ($modulo) {
                'producto' => 'Productos',
                'categoria' => 'Categorías',
                'proveedor' => 'Proveedores',
                'compra' => 'Compras',
                'cliente' => 'Clientes',
                'ubicacion' => 'Ubicaciones',
                'facturas' => 'Facturas',
                'impuesto' => 'Impuestos',
                'roles', 'usuarios', 'configuracion' => 'Configuración',
                'registro' => 'Registro',
                default => 'Otros',
            };
        });
    }
}
?>