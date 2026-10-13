<?php

namespace App\Models;

use App\Traits\CodigoFactura;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class factura extends Model
{
    use HasFactory;
    use CodigoFactura;

    protected $table = 'factura';

    protected $fillable = [
        'codigo',
        'id_cliente',
        'estado',
        'observaciones',
        'metodo_pago',
        'total'
    ];

    protected static function boot()
    {
        parent::boot();
        self::bootCodigoFactura();
    }

    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'id_cliente');
    }

    public function detalleFactura()
    {
        return $this->hasMany(detalleFactura::class, 'id_factura');
    }
}
