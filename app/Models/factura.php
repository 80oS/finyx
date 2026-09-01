<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    protected $table = 'factura';

    protected $fillable = [
        'codigo',
        'id_cliente',
        'estado',
        'observaciones',
        'metodo_pago',
        'total'
    ];

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'id_cliente');
    }

    public function destalleFactura()
    {
        return $this->hasMany(detalleFactura::class);
    }
}
