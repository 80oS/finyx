<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    
    protected $table = 'ubicacion';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'tipo',
        'estado',
        'capacidad',
        'unidad_capacidad',
        'id_ubicacion_padre'
    ];

    public function ProductoUbicacion()
    {
        return $this->hasMany(ProductoUbicacion::class, 'id_ubicacion');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 
                        'producto_ubicacion', 
                        'id_producto', 
                        'id_ubicacion')->withPivot('cantidad')->withTimestamps();
    }

    public function padre()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion_padre');
    }

    public function hijo()
    {
        return $this->hasMany(Ubicacion::class, 'id_ubicacion_padre');
    }
}
