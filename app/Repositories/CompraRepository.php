<?php
namespace App\Repositories;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;

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

    public function aumentarStockPorNombre(string $nombre, int $cantidad): bool
    {
        $producto = Producto::whereRaw('LOWER(nombre) = ?', [mb_strtolower(trim($nombre))])->first();

        if (!$producto) {
            return false;
        }

        $producto->increment('stock', $cantidad);

        return true;
    }
}