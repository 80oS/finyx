<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class HistorialCompras extends Component
{
    public $tipo = 'mes';   
    public $valor = '';    
    public $pagina = 1;
    public $porPagina = 10;

    public function updatedTipo()
    {
        $this->valor = '';
        $this->pagina = 1;
    }

    public function updatedValor()
    {
        $this->pagina = 1;
    }

    public function limpiar()
    {
        $this->valor = '';
        $this->pagina = 1;
    }

    public function siguiente()
    {
        $this->pagina++;
    }

    public function anterior()
    {
        if ($this->pagina > 1) {
            $this->pagina--;
        }
    }

    public function render()
    {
        $query = DB::table('compra')
            ->join('proveedor', 'proveedor.id', '=', 'compra.id_proveedor')
            ->select('compra.id', 'proveedor.nombre', 'compra.metodo_pago', 'compra.total', 'compra.created_at');

        if ($this->valor) {
            if ($this->tipo === 'mes') {
                $query->whereRaw("strftime('%Y-%m', compra.created_at) = ?", [$this->valor]);
            } else {
                $query->whereDate('compra.created_at', $this->valor);
            }
        }

        $compras = $query->orderByDesc('compra.created_at')
            ->offset(($this->pagina - 1) * $this->porPagina)
            ->limit($this->porPagina)
            ->get();

        return view('livewire.historial-compras', ['compras' => $compras])
            ->extends('layouts.app')
            ->section('content');
    }
}