<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoUbicacion extends Model
{
    use HasFactory;
    
    protected $table = 'producto_ubicacion';

    protected $fillable = [
        'id_producto',
        'id_ubicacion',
        'cantidad'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
}
