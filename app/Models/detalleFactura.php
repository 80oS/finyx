<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detalleFactura extends Model
{
    protected $table = "detalle_factura";

    protected $fillable = [
        'id_producto',
        'id_factura',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    public function producto()
    {
        return $this->belongsTo(producto::class, 'id_producto');
    }

    public function factura()
    {
        return $this->belongsTo(factura::class, 'id_factura');
    }
}
