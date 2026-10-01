<?php

namespace Database\Seeders;

use App\Models\categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categoria::create([
            'nombre' => 'granos',
            'descripcion' => 'lentejas, frijol, etc',
            'estado' => true
        ]);
        categoria::create([
            'nombre' => 'bebidas',
            'descripcion' => 'jugos, gaseosas',
            'estado' => true
        ]);
        categoria::create([
            'nombre' => 'carnes',
            'descripcion' => 'res, cerdo',
            'estado' => true
        ]);
        categoria::create([
            'nombre' => 'enlatados',
            'descripcion' => 'atun, sardina',
            'estado' => true
        ]);
    }
}
