<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class impuesto extends Model
{
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
}
