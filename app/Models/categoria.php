<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = "categoria";

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function producto()
    {
        $this->hasMany(categoria::class);
    }
}
