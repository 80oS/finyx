<?php

namespace App\Livewire;

use App\Models\Ubicacion;
use Livewire\Component;

class CalcularOcupacion extends Component
{
    public int $ubicacionId;

    public function mount(int $ubicacionId): void
    {
        $this->ubicacionId = $ubicacionId;
    }

    public function render()
    {
        $ubicacion = Ubicacion::query()->withSum('ProductoUbicacion as unidadesAlmacenadas', 'cantidad' )
            ->findOrFail($this->ubicacionId);
        
        $unidades = (float) ($ubicacion->unidadesAlmacenadas ?? 0);
        $capacidad = (float) ($ubicacion->capacidad ?? 0);

        $porcentaje = $capacidad > 0 ? round(($unidades / $capacidad) * 100, 1) : null;

        $anchoBarra = $porcentaje !== null ? min(100, $porcentaje) : 0;

        $color = match (true) {
            $porcentaje === null => 'bg-gris-calido-claro',
            $porcentaje >= 90 => 'bg-terracota-suave',
            $porcentaje >= 70 => 'bg-ambar-claro',
            default => 'bg-verde-salvia',
        };

        return view('livewire.calcular-ocupacion', compact(
            'ubicacion',
            'unidades',
            'capacidad',
            'porcentaje',
            'anchoBarra',
            'color'
        ));
    }
}
