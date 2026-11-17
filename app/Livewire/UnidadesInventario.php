<?php

namespace App\Livewire;

use App\Repositories\HomeRepository;
use Livewire\Component;

class UnidadesInventario extends Component
{
    public function render(HomeRepository $repo)
    {
        return view('livewire.unidades-inventario', [
            'totalUnidades' => $repo->totalUnidades(),
        ]);
    }
}