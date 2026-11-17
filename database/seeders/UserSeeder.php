<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email' => 'desarrollador@finyx.com',
            'name' => 'Desarrollador',
            'password' => '123456789'
        ]);
        User::create([
            'email' => 'admin@finyx.com',
            'name' => 'Administrador',
            'password' => '123456789'
        ]);
        User::create([
            'email' => 'cajero@finyx.com',
            'name' => 'Cajero',
            'password' => '123456789'
        ]);
    }
}
