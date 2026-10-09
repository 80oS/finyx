<?php

namespace App\Traits;

use App\Models\factura;

trait CodigoFactura
{
    protected static function bootCodigoFactura(): void
    {
        static::creating(function (factura $factura): void {
            if (empty($factura->codigo)) {
                $factura->codigo = self::generarCodigoFactura();
            }
        });
    }


    public static function generarCodigoFactura(): string
    {
        $ultimaFactura = factura::latest('codigo')->first();

        if (!$ultimaFactura) {
            $nextNumber = 1;
        } else {
            $lastCode = $ultimaFactura->codigo;
            $lastNumber = intval(substr($lastCode, 2));
            $nextNumber = $lastNumber + 1;
        }

        $nuevoCodigo = 'FAC' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Asegurarse de que el código sea único
        while (static::where('codigo', $nuevoCodigo)->exists()) {
            $nextNumber++;
            $nuevoCodigo = 'FAC' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }

        return $nuevoCodigo;
    }
}
