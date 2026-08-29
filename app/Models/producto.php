<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    protected $table = 'producto';
    
    protected $fillable = [
        'nombre',
        'codigo',
        'barcode',
        'precio_unitario',
        'stock',
        'fecha_vencimiento',
        'ubicacion_real',
        'estado',
        'id_categoria'
    ];

    public function categoria()
    {
        $this->belongsTo(categoria::class, 'id_categoria');
    }
}
