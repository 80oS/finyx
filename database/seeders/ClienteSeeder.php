<?php

namespace Database\Seeders;

use App\Models\cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{

    public function run(): void
    {
        cliente::create([
            'cedula' => '1032323232',
            'correo' => 'jose@gmail.com',
            'direccion' => 'cra 12',
            'nombre' => 'jose bermudez',
            'telefono' => '32123332132'
        ]);
    }
}
