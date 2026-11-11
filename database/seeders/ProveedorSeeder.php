<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            [
                'nit' => '900100001-1',
                'cedula' => '100100001',
                'nombre' => 'Distribuidora El Campo',
                'telefono' => '3151112233',
                'direccion' => 'Málaga, Santander',
                'correo' => 'campo@prueba.com',
            ],
            [
                'nit' => '900100002-2',
                'cedula' => '100100002',
                'nombre' => 'Comercializadora Central',
                'telefono' => '3162223344',
                'direccion' => 'Málaga, Santander',
                'correo' => 'central@prueba.com',
            ],
            [
                'nit' => '900100003-3',
                'cedula' => '100100003',
                'nombre' => 'Abarrotes del Norte',
                'telefono' => '3173334455',
                'direccion' => 'Málaga, Santander',
                'correo' => 'abarrotes@prueba.com',
            ],
            [
                'nit' => '900100004-4',
                'cedula' => '100100004',
                'nombre' => 'Distribuciones La Economía',
                'telefono' => '3184445566',
                'direccion' => 'Málaga, Santander',
                'correo' => 'economia@prueba.com',
            ],
            [
                'nit' => '900100005-5',
                'cedula' => '100100005',
                'nombre' => 'Comercializadora San José',
                'telefono' => '3195556677',
                'direccion' => 'Málaga, Santander',
                'correo' => 'sanjose@prueba.com',
            ],
        ];

        foreach ($proveedores as $proveedor) {
            DB::table('proveedor')->updateOrInsert(
                ['nit' => $proveedor['nit']],
                array_merge($proveedor, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
