<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoImpuesto extends Model
{
    protected $table = 'impuesto_producto';

    protected $fillable = [
        'id_producto',
        'id_impuesto'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function impuesto()
    {
        return $this->belongsTo(impuesto::class, 'id_impuesto');
    }
}
