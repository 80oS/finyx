@extends('layouts.app')

@section('titulo', 'impuestos')

@section('content')
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Impuestos
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('impuesto.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido 
                rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>Impuesto</th>
                    <th>Tarifa</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Cambiar Estado</th>
                    <th>Asignar productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($impuestos as $impuesto)
                    <tr>
                        <td>{{ $impuesto->nombre }}</td>
                        <td>{{ $impuesto->porcentaje }}</td>
                        <td>{{ $impuesto->estado ? 'activo' : 'inactivo' }}</td>
                        <td>
                            <a href="{{ route('impuesto.edit', $impuesto->id) }}" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('impuesto.changeState', $impuesto->id) }}" method="POST" wire:navigate>
                                @csrf
                                @if ($impuesto->estado == 1)
                                    <button type="submit"
                                        class="bg-terracota-suave hover:bg-terracota-oscuro 
                                        text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer" wire:navigate>
                                        desabilitar
                                    </button>
                                @else
                                    <button type="submit"
                                        class="bg-verde-salvia hover:bg-verde-salvia-claro 
                                        text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer" wire:navigate>
                                        habilitar
                                    </button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('impuesto.show', $impuesto->id) }}" 
                                class="text-center text-azul-grisaceo 
                                hover:text-azul-grisaceo-oscuro text-base">
                                
                                <i class="fa-solid fa-link"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection