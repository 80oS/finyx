<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';

    protected $fillable = [
        'nombre',
        'tipo',
        'estado'
    ];

    public function ProductoUbicacion()
    {
        return $this->hasMany(ProductoUbicacion::class);
    }
}
