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

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nit</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nit }}</td>
                        <td>{{ $proveedor->cedula }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->direccion }}</td>
                        <td>{{ $proveedor->correo }}</td>
                        <td>
                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
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