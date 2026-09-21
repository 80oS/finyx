@extends('layout.app')

@section('titulo', 'Lista de Categorias')

@section('content')

    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl tracking-tight text-gris-calido-oscuro">
            Categorias
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('categoria.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-6 py-3 font-medium">Id</th>
                    <th class="px-6 py-3 font-medium">Nombre</th>
                    <th class="px-6 py-3 font-medium">Descripcion</th>
                    <th class="px-6 py-3 font-medium">Estado</th>
                    <th class="px-6 py-3 font-medium">Editar</th>
                    <th class="px-6 py-3 font-medium">Cambiar Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $categoria->id }}</td>
                        <td class="px-6 py-4">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-4">{{ $categoria->descripcion }}</td>
                        <td class="px-6 py-4">{{ $categoria->estado == 1 ? 'activo' : 'inactivo' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('categoria.edit', $categoria->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('categoria.changeState', $categoria->id) }}" method="POST">
                                @csrf
                                @if ($categoria->estado == 1)
                                    <button type="submit"
                                    class="bg-terracota-suave hover:bg-terracota-oscuro 
                                    text-blanco-calido rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        desabilitar</button>
                                @else
                                    <button type="submit"
                                    class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection