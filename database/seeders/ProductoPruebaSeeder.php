<?php

namespace Database\Seeders;

use App\Models\producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoPruebaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categoria')->insertOrIgnore([
            'id' => 1, 'nombre' => 'General',
        ]);
        DB::table('impuesto')->insertOrIgnore([
            'id' => 1, 'nombre' => 'IVA', 'porcentaje' => 19,
        ]);

        $datos = [
            ['Arroz',  'T001', 2],
            ['Aceite', 'T002', 3],
            ['Azúcar', 'T003', 2000],
            ['Sal',    'T004', 120],
        ];

        foreach ($datos as $i => [$nombre, $codigo, $stock]) {
            producto::create([
                'nombre'            => $nombre,
                'codigo'            => $codigo,
                'barcode'           => '100000000000' . ($i + 1),
                'precio_unitario'   => 3000,
                'stock'             => $stock,
                'fecha_vencimiento' => '2027-01-01',
                'estado'            => 1,
                'id_categoria'      => 1,
                'id_impuesto'       => 1,
            ]);
        }
    }
}