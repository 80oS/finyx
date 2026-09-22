@extends('layout.app')

@section('titulo', 'Lista de Clientes')

@section('content')

    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
            Clientes
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('cliente.create') }}" 
                class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido 
                rounded-sm px-5 py-1 text-right transition-all w-20">
                crear
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-6 py-3 font-medium">Id</th>
                    <th class="px-6 py-3 font-medium">Nombre</th>
                    <th class="px-6 py-3 font-medium">Cedula</th>
                    <th class="px-6 py-3 font-medium">Telefono</th>
                    <th class="px-6 py-3 font-medium">Correo</th>
                    <th class="px-6 py-3 font-medium">Dirección</th>
                    <th class="px-6 py-3 font-medium">Editar</th>
                    <th class="px-6 py-3 font-medium">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente as $cliente)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $cliente->id }}</td>
                        <td class="px-6 py-4">{{ $cliente->nombre }}</td>
                        <td class="px-6 py-4">{{ $cliente->cedula }}</td>
                        <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                        <td class="px-6 py-4">{{ $cliente->correo }}</td>
                        <td class="px-6 py-4">{{ $cliente->direccion }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('cliente.edit', $cliente->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="text-terracota-suave hover:text-terracota-oscuro 
                                    text-base px-5 py-1 transition-all cursor-pointer"
                                    onclick="return confirm('Seguro que quiere eliminar este cliente')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection