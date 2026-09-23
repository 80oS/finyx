<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class impuesto extends Model
{
    protected $table = 'producto';
    
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'porcentaje'
    ];
}
