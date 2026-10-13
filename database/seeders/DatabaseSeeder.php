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
<<<<<<< HEAD
            [ ImpuestoSeeder::class]
        );
    
=======
            [ CategoriaSeeder::class, ProductoSeeder::class]
        );
>>>>>>> 202f6a0fed0ba17b53d2c85842b785f098e5f497
    }
}
