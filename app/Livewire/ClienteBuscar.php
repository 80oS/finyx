<?php

namespace App\Livewire;
use App\Models\cliente;
use Livewire\Component;

class ClienteBuscar extends Component
{
    public $identificacion = '';
    public $sugerencias = [];
    public $nombre = '';
    public ?int $clienteSeleccionado = null;

    public function buscarCliente()
    {
        $identificacion = trim($this->identificacion);

        $this->clienteSeleccionado = null;

        if(strlen($identificacion) < 2){
            return $this->sugerencias = [];
        }else{
            $this->sugerencias = cliente::query()->where('cedula', 'like', '%' . $identificacion . '%')
            ->limit(5)->get()->toArray();
        }
    }

    public function seleccionarCliente(int $id): void
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $this->clienteSeleccionado = null;
            $this->nombre = '';
            $this->addError('identificacion', 'El cliente no existe.');
            return;
        }

        $this->clienteSeleccionado = $cliente->id;
        $this->nombre = $cliente->nombre;
        $this->identificacion = $cliente->cedula;

        $this->sugerencias = [];

        $this->resetErrorBag('identificacion');
    }

    public function render()
    {
        return view('livewire.cliente-buscar');
    }
}
