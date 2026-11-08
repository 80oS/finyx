<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    
    protected $fillable = [
        'nombre',
        'codigo',
        'barcode',
        'precio_unitario',
        'stock',
        'fecha_vencimiento',
        'estado',
        'id_categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(categoria::class, 'id_categoria');
    }

    public function detalleFactura()
    {
        return $this->hasMany(detalleFactura::class, 'id_producto');
    }

    public function productoUbicacion()
    {
        return $this->hasMany(ProductoUbicacion::class, 'id_producto');
    }

    public function ubicaciones()
    {
        return $this->belongsToMany(Ubicacion::class,
            'producto_ubicacion',
            'id_producto',
            'id_ubicacion'
        )->withPivot('cantidad')->withTimestamps();
    }

    public function productoImpuesto()
    {
        return $this->hasMany(productoImpuesto::class, 'id_producto');
    } 

}
