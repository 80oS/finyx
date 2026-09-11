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
        $factura = factura::create($datos);
        
        foreach($datos['productos'] as $dato_producto){
            $factura->detalleFactura()->create($dato_producto);
        }
    }

    public function show(int $id)
    {
        return factura::with(['cliente', 'detalleFactura.producto' ])->where('id', $id)->firstOrFail();
    }
}
?>