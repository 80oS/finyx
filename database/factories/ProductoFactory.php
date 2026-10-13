<?php

namespace Database\Factories;

use App\Models\categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->words(3, true),

            'codigo' => fake()->unique()->bothify('PROD-####'),

            'barcode' => fake()->unique()->ean13(),

            'precio_unitario' => fake()->randomFloat(2, 1000, 500000),

            'stock' => fake()->numberBetween(0, 100),

            'fecha_vencimiento' => fake()->optional()->dateTimeBetween('now', '+2 years'),

            'estado' => fake()->boolean(),

            'id_categoria' => categoria::inRandomOrder()->value('id'),
        ];
    }
}
