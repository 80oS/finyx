<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(
            [   CategoriaSeeder::class, 
                ProductoSeeder::class, 
                ClienteSeeder::class, 
                VentaSeeder::class,
                PermisoSeeder::class,
                RolSeeder::class,
                RolePermissionSeeder::class,
                UserSeeder::class,
                UserRoleSeeder::class
            ]
        );
    }
}
