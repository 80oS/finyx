@extends('layouts.app')

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

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cliente as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->cedula }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ $cliente->correo }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            <a href="{{ route('cliente.edit', $cliente->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
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