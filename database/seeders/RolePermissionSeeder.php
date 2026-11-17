<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $desarrollador = Role::findByName(
            'Desarrollador',
            'web'
        );

        $administrador = Role::findByName(
            'Administrador',
            'web'
        );

        $cajero = Role::findByName(
            'Cajero',
            'web'
        );

        $desarrollador->syncPermissions(
            \Spatie\Permission\Models\Permission::all()
        );

        $administrador->syncPermissions([
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

            'usuarios.ver',
            
            'registro.ver',
            'registro.crear'
        ]);


        $cajero->syncPermissions([
            'producto.ver',
            'facturas.ver',
            'facturas.crear',
        ]);

    }
}
