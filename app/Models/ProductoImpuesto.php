<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoImpuesto extends Model
{
    use HasFactory;
    
    protected $table = 'impuesto_producto';

    protected $fillable = [
        'id_producto',
        'id_impuesto',
        'tarifa_aplicada',
        'fecha_inicio',
        'fecha_fin',
        'estado'
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
