@extends('layout.app')

@section('titulo', 'Lista de Proveedores')

@section('content')

    @if (session('success'))
        <div class=" bg-green-700/15 border border-green-400 text-slate-400 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Proveedores
        </div>

        <div class="flex items-end justify-end">
            <a href="{{ route('proveedores.create') }}"
                class="bg-green-700 hover:bg-green-900 text-white rounded-sm px-5 py-1 text-right transition-all w-20">
                crear
            </a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">

            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <tr>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Id</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Nit</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Cedula</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Nombre</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Telefono</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Dirección</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Correo</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Editar</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Eliminar</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">

                @foreach ($proveedores as $proveedor)

                    <tr class="bg-gray-300 hover:bg-gray-400 transition-all">

                        <td class="p-3 border border-gray-800">{{ $proveedor->id }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->nit }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->cedula }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->nombre }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->telefono }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->direccion }}</td>
                        <td class="p-3 border border-gray-800">{{ $proveedor->correo }}</td>

                        <td class="p-3 border border-gray-800 text-center">

                            <a href="{{ route('proveedores.edit', $proveedor->id) }}" 
                                class="bg-sky-700 hover:bg-sky-900 rounded-sm px-5 py-1 text-white">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>

                        <td class="p-3 border border-gray-800 text-center">
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white rounded-sm px-5 py-1 transition-all cursor-pointer"
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