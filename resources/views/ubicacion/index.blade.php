@extends('layouts.app')

@section('titulo', 'ubicacion producto')

@section('content')
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
            Productos
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('ubicacion.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-3 py-3 font-medium">#</th>
                    <th class="px-3 py-3 font-medium">codigo</th>
                    <th class="px-3 py-3 font-medium">ubicacion principal</th>
                    <th class="px-3 py-3 font-medium">nombre</th>
                    <th class="px-3 py-3 font-medium">tipo</th>
                    <th class="px-3 py-3 font-medium">cantidad productos</th>
                    <th class="px-3 py-3 font-medium">estado</th>
                    <th class="px-3 py-3 font-medium">editar</th>
                    <th class="px-3 py-3 font-medium">ver detalles</th>
                    <th class="px-3 py-3 font-medium">cambiar estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ubicaciones as $index => $ubicacion)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                    <td class="p-3">{{ $ubicacion->codigo }}</td>
                    <td class="p-3">{{ $ubicacion->padre?->nombre ?? 'Sin ubicacion principal' }}</td>
                    <td class="p-3">{{ $ubicacion->nombre }}</td>
                    <td class="p-3">{{ $ubicacion->tipo }}</td>
                    <td class="p-3">{{ $ubicacion->producto_ubicacion_count }}</td>
                    <td class="p-3">{{ $ubicacion->estado }}</td>
                    <td class="p-3">
                        <a href="" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="p-3">
                        <a href="" class="text-ambar-claro hover:text-ambar-oscuro p-1 text-base">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                    <td class="p-3">
                        <form action="">
                            @if ($ubicacion->estado == 'activo')
                                <button type="submit"
                                    class="bg-terracota-suave hover:bg-terracota-oscuro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all 
                                    cursor-pointer">
                                    desabilitar
                                </button>

                            @else
                                <button type="submit"
                                    class="bg-verde-salvia hover:bg-verde-salvia-claro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all 
                                    cursor-pointer">
                                    habilitar
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection