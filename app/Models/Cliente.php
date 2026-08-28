<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'cliente';

    protected $fillable = [
        'cedula',
        'nombre',
        'telefono',
        'direccion',
        'correo',
    ];
}