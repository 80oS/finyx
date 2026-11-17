<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();

        $permisos = [
            'producto.ver',
            'producto.crear',
            'producto.editar',
            'producto.changeState',

            'categoria.ver',
            'categoria.crear',
            'categoria.editar',
            'categoria.changeState',
            'categoria.productos',

            'proveedor.ver',
            'proveedor.crear',
            'proveedor.editar',
            'proveedor.eliminar',

            'compra.ver',
            'compra.crear',
            'compra.historial',

            'cliente.ver',
            'cliente.crear',
            'cliente.editar',
            'cliente.eliminar',

            'ubicacion.ver',
            'ubicacion.crear',
            'ubicacion.editar',
            'ubicacion.changeState',
            'ubicacion.asignar-productos',
            'ubicacion.mover-productos',

            'facturas.ver',
            'facturas.crear',

            'impuesto.ver',
            'impuesto.crear',
            'impuesto.editar',
            'impuesto.show',
            'impuesto.changeState',
            'impuesto.producto',
            'impuesto.detalle',

            'roles.ver',
            'roles.crear',
            'roles.editar', 
            'roles.asignar-permisos',

            'usuarios.ver',
            'usuarios.editar',
            'configuracion',
            'usuarios.role.anular',

            'registro.ver',
            'registro.crear'

        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate([
                'name' => $permiso,
                'guard_name' => 'web',
            ]);
        }
        app(PermissionRegistrar::class)
            ->forgetCachedPermissions();
    }
}
