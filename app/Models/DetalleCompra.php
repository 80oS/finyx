<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compra';

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];
}