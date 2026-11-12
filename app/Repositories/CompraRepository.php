<?php
namespace App\Repositories;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;

class CompraRepository{

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
        $Compras = Compra::findOrFail($id);
        $Compras->update($datos);
    }

    public function proveedores()
    {
        return Proveedor::all();
    }

    public function productos()
    {
        return Producto::orderBy('nombre')->get();
    }

    public function nombreProducto(int $idProducto): ?string
    {
        return Producto::where('id', $idProducto)->value('nombre');
    }

    public function crearDetalle(array $datos)
    {
        return DetalleCompra::create($datos);
    }

    public function aumentarStock(int $idProducto, int $cantidad): void
    {
        Producto::where('id', $idProducto)->increment('stock', $cantidad);
    }
}