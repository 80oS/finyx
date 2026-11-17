<?php
namespace App\Repositories;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Str;

class CompraRepository
{
    public function index()
    {
        return Compra::with('proveedor')->get();
    }

    public function crear(array $datos)
    {
        return Compra::create($datos);
    }

    public function buscarId(int $id)
    {
        return Compra::findOrFail($id);
    }

    public function update(int $id, array $datos)
    {
        $compra = Compra::findOrFail($id);
        $compra->update($datos);
    }

    public function eliminar(int $id): void
    {
        DetalleCompra::where('id_compra', $id)->delete();
        Compra::findOrFail($id)->delete();
    }

    public function proveedores()
    {
        return Proveedor::all();
    }

    public function crearDetalle(array $datos)
    {
        return DetalleCompra::create($datos);
    }

    public function aumentarStockPorNombre(string $nombre, int $cantidad,  float $precio): bool
    {
        $nombre = trim($nombre);

        $producto = Producto::whereRaw(
            'LOWER(nombre) = ?',
            [mb_strtolower($nombre)]
        )->first();

        if (!$producto) {

            $producto = Producto::create([
                'nombre' => $nombre,
                'codigo' => $this->generarCodigo(),
                'barcode' => $this->generarBarcode(),
                'precio_unitario' => $precio,
                'stock' => $cantidad,
                'fecha_vencimiento' => null,
                'estado' => 1,
                'id_categoria' => 1,
            ]);

            return true;
        }

        $producto->increment('stock', $cantidad);

        return true;
    }

    private function generarCodigo(): string
    {
        do {
            $codigo = 'PROD-' . strtoupper(Str::random(8));
        } while (Producto::where('codigo', $codigo)->exists());

        return $codigo;
    }

    private function generarBarcode(): string
    {
        do {
            // Generar 12 dígitos aleatorios
            $base = '';

            for ($i = 0; $i < 12; $i++) {
                $base .= random_int(0, 9);
            }

            // Calcular dígito de control EAN-13
            $suma = 0;

            for ($i = 0; $i < 12; $i++) {
                $digito = (int) $base[$i];

                $suma += $digito * ($i % 2 === 0 ? 1 : 3);
            }

            $digitoControl = (10 - ($suma % 10)) % 10;

            $barcode = $base . $digitoControl;
        } while (Producto::where('barcode', $barcode)->exists());

        return $barcode;
    }
}