<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    public function definition(): array
    {
        $fecha = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'id_proveedor' => Proveedor::inRandomOrder()->value('id'),
            'metodo_pago'  => fake()->randomElement(['tarjeta', 'transferencia', 'efectivo']),
            'total'        => fake()->randomFloat(2, 10, 5000),
            'created_at'   => $fecha,
            'updated_at'   => $fecha,
        ];
    }
}