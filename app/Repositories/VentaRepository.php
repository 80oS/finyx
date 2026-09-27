<?php
namespace App\Repositories;

use App\Models\cliente;
use App\Models\factura;

class VentaRepository{
    public function index()
    {
        return factura::with('cliente')->get();
    }

    public function create(array $datos)
    {
        $productos = $datos['productos'];

        unset($datos['productos']);

        $factura = factura::create($datos);

        foreach ($productos as $dato_producto) {
            $factura->detalleFactura()->create($dato_producto);
        }

        return $factura;
    }

    public function show(int $id)
    {
        return factura::with(['cliente', 'detalleFactura.producto' ])->where('id', $id)->firstOrFail();
    }
}
?>