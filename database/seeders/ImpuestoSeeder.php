<?php

namespace Database\Seeders;

use App\Models\impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpuestoSeeder extends Seeder
{
    public function run(): void
    {
        impuesto::create([
        'nombre' => 'IVA 19%',
        'fecha_inicio' => '2026-01-01',
        'fecha_fin' => '',
        'porcentaje' => 0.19
        ]);

        
    }
}
