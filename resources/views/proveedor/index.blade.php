@extends('layouts.app')

@section('titulo', 'Lista de Proveedores')

@section('content')

    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Proveedores
        </div>

        <div class="flex items-end justify-end">
            <a href="{{ route('proveedores.create') }}"
                class="bg-verde-salvia hover:bg-verde-salvia text-blanco-calido 
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
                    <th class="px-6 py-3 font-medium">Nit</th>
                    <th class="px-6 py-3 font-medium">Cedula</th>
                    <th class="px-6 py-3 font-medium">Nombre</th>
                    <th class="px-6 py-3 font-medium">Telefono</th>
                    <th class="px-6 py-3 font-medium">Dirección</th>
                    <th class="px-6 py-3 font-medium">Correo</th>
                    <th class="px-6 py-3 font-medium">Editar</th>
                    <th class="px-6 py-3 font-medium">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $proveedor->id }}</td>
                        <td class="p-3">{{ $proveedor->nit }}</td>
                        <td class="p-3">{{ $proveedor->cedula }}</td>
                        <td class="p-3">{{ $proveedor->nombre }}</td>
                        <td class="p-3">{{ $proveedor->telefono }}</td>
                        <td class="p-3">{{ $proveedor->direccion }}</td>
                        <td class="p-3">{{ $proveedor->correo }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="p-3 text-center">
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-terracota-suave hover:text-terracota-oscuro 
                                    rounded-sm px-2 py-1 transition-all cursor-pointer text-base"
                                    onclick="return confirm('Seguro que quiere eliminar este proveedor')">
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