<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            'desarrollador@finyx.com' => 'Desarrollador',
            'admin@finyx.com'         => 'Administrador',
            'cajero@finyx.com'        => 'Cajero',
        ];

        foreach ($usuarios as $email => $nombreRol) {

            $usuario = User::where('email', $email)->first();

            if (!$usuario) {
                throw new RuntimeException(
                    "No existe el usuario: {$email}"
                );
            }

            $rol = Role::findByName($nombreRol, 'web');

            // Asignar rol al usuario
            $usuario->syncRoles([$rol]);
        }
    }
}
