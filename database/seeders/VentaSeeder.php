<?php

namespace Database\Seeders;

use App\Models\factura;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = Producto::inRandomOrder()
            ->take(200)
            ->get();

        if ($productos->count() < 200) {
            $this->command->error(
                'No existen 200 productos en la base de datos.'
            );

            return;
        }

        $factura = factura::create([
            'codigo' => fake()->unique()->numerify('FAC-002'),
            'id_cliente' => 1,
            'estado' => 'pagado',
            'observaciones' => 'Venta de prueba con 200 productos',
            'metodo_pago' => 'efectivo',
            'total' => 0,
        ]);

        $total = 0;

        foreach ($productos as $producto) {

            $cantidad = fake()->numberBetween(1, 5);

            $subtotal = $cantidad * $producto->precio_unitario;

            $factura->detalleFactura()->create([
                'id_producto' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio_unitario,
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $factura->update([
            'total' => $total,
        ]);

        $this->command->info(
            "Venta creada correctamente con 200 productos."
        );

        $this->command->info(
            "Factura: {$factura->codigo}"
        );

        $this->command->info(
            "Total: $" . number_format($total, 2)
        );
    }
}
