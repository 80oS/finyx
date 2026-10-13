<?php

namespace App\Livewire;

use App\Repositories\HomeRepository;
use Livewire\Component;

class ProductoMasVendido extends Component
{
    public function render(HomeRepository $homeRepository)
    {
        return view('livewire.producto-mas-vendido', [
            'masVendidos' => $homeRepository->masVendidos(),
        ]);
    }
}