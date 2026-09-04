<?php
namespace App\Repositories;

use App\Models\factura;

class VentaRepository{
    public function index()
    {
        return factura::with('cliente')->get();
    }

    public function show(int $id)
    {
        return factura::with(['cliente', 'detalleFactura.producto' ])->where('id', $id)->firstOrFail();
    }
}
?>