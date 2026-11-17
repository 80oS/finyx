<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class impuesto extends Model
{   
    use HasFactory;
    
    protected $table = 'impuesto';
    
    protected $fillable = [
        'nombre',
        'codigo',
        'porcentaje',
        'tipo_calculo',
        'tipo_impuesto',
        'estado',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function productoImpuesto()
    {
        return $this->hasMany(ProductoImpuesto::class, 'id_impuesto');
    }

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            'impuesto_producto',
            'id_impuesto',
            'id_producto'
        );
    }
}
