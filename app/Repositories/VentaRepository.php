<?php
namespace App\Repositories;

use App\Models\factura;

class VentaRepository{
    public function index(){
        return factura::with('cliente')->get();
    }
}
?>