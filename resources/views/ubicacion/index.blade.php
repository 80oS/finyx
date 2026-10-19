@extends('layouts.app')

@section('titulo', 'ubicacion producto')

@section('content')
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="flex items-center justify-start gap-3">
            <div>
                <i><x-lucide-warehouse class="w-8 h-8 text-verde-suave"/></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
                    Ubicaciones
                </h1>
            </div>
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('ubicacion.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>#</th>
                    <th>codigo</th>
                    <th>ubicacion principal</th>
                    <th>nombre</th>
                    <th>tipo</th>
                    <th>cantidad productos</th>
                    <th>estado</th>
                    <th>editar</th>
                    <th>ver detalles</th>
                    <th>cambiar estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ubicaciones as $index => $ubicacion)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ubicacion->codigo }}</td>
                    <td>{{ $ubicacion->padre?->nombre ?? 'Sin ubicacion principal' }}</td>
                    <td>{{ $ubicacion->nombre }}</td>
                    <td>{{ $ubicacion->tipo }}</td>
                    <td>{{ $ubicacion->producto_ubicacion_count }}</td>
                    <td>{{ $ubicacion->estado }}</td>
                    <td>
                        <a href="" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base p-1 transition-all">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="" class="text-ambar-claro hover:text-ambar-oscuro p-1 text-base">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                    <td>
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