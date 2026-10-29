@extends('layouts.app')

@section('titulo', 'Detalles de la ubicacion')

@section('content')

    <div class="flex items-center gap-5 mb-5">
        <div>
            <a href="{{ route('ubicacion.index') }}">
                <x-lucide-chevron-left class="w-6 h-6 text-gris-calido-oscuro hover:text-gris-suave"/>
            </a>
        </div>
        <div>
            <label for="" class="uppercase text-gris-suave font-bold text-sm">Inventario</label>
            <h1 class="capitalize text-gris-calido-oscuro font-bold text-lg">Detalle de ubicacion</h1>
        </div>
    </div>
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success 
        text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-center">
        <div class="w-full max-w-3xl border border-blanco-calido 
            shadow shadow-gris-suave bg-blanco-calido p-5 rounded-md">
            <div class="flex flex-row items-center justify-start gap-3">
                <div>
                    <x-lucide-map class="w-8 h-8 text-verde-suave"/>
                </div>
                <div>
                    <h1 class="font-bold capitalize text-gris-calido-oscuro">{{ $ubicacion->nombre }}</h1>
                    <span class="text-gris-calido-claro">{{ $ubicacion->codigo }} - {{ $ubicacion->tipo }}</span>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between my-3">
                <div>
                    <h3 class="text-gris-calido-claro capitalize">
                        Productos distintos
                    </h3>
                    <span class="text-center text-gris-calido-claro">{{ $ubicacion->productosDistintos ?? 0 }}</span>
                </div>
                <div>
                    <h3 class="text-gris-calido-claro capitalize">
                        unidades almacenadas
                    </h3>
                    <span class="text-center text-gris-calido-claro">{{ $ubicacion->unidadesAlmacenadas ?? 0 }}</span>
                </div>
            </div>
            <div class="border border-gris-suave rounded-md p-5">
                <h2 class="text-gris-calido-oscuro font-bold">Información de la Ubicación</h2>
                <div class="grid grid-cols-2">
                    <div class="text-gris-calido-oscuro">
                        <div>
                            <h3>Ubicación Superior / Principal</h3>
                        </div>
                        <div>
                            <h3>Código</h3>
                        </div>
                        <div>
                            <h3>Capacidad</h3>
                        </div>
                    </div>
                    <div class="text-gris-calido-oscuro">
                        <div>
                            <h3>{{ $ubicacion->padre?->nombre ?? 'ubicacion principal' }}</h3>
                        </div>
                        <div>
                            <h3>{{ $ubicacion->codigo }}</h3>
                        </div>
                        <div>
                            <h3>{{ number_format($ubicacion->capacidad) }}</h3>
                        </div>
                    </div>
                </div>
                <div>
                    <livewire:calcular-ocupacion :ubicacion-id="$ubicacion->id"/>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between my-3">
                <h2 class="caplitalize text-gris-calido-claro font-bold">productos almacenados</h2>
                <livewire:asignar-productos-ubicacion :ubicacion-id="$ubicacion->id"/>
            </div>
            <div class="rounded-md">
                <table class="w-full border border-collapse border-linea-exterior-tabla">
                    <thead class="text-gris-calido-oscuro border-b border-linea-thead">
                        <tr>
                            <th class="p-2">Nombre</th>
                            <th class="p-2">Codigo</th>
                            <th class="p-2">Unidades</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ubicacion->ProductoUbicacion as $asigna)
                            <tr class="text-gris-calido-oscuro border border-linea-tr-tbody text-center">
                                <td>{{ $asigna->producto->nombre }}</td>
                                <td>{{ $asigna->producto->codigo }}</td>
                                <td>{{ $asigna->cantidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection            