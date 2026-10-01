<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    
    protected $table = 'cliente';

    protected $fillable = [
        'cedula',
        'nombre',
        'telefono',
        'direccion',
        'correo',
    ];

    public function factura()
    {
        return $this->hasMany(factura::class);
    }
}