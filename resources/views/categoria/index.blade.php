@extends('layout.app')

@section('titulo', 'Lista de Categorias')

@section('content')

    @if (session('success'))
        <div class=" bg-green-700/10 border border-green-400 text-gray-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Categorias
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('categoria.create') }}" 
            class="bg-green-700 hover:bg-green-900 text-white rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <tr>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Id</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Nombre</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Descripcion</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Estado</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Editar</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Cambiar Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                @foreach ($categorias as $categoria)
                    <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                        <td class="p-3 border border-gray-800">{{ $categoria->id }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $categoria->descripcion }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $categoria->estado == 1 ? 'activo' : 'inactivo' }}</td>
                        <td class="px-6 py-4 border border-gray-800 text-center">
                            <a href="{{ route('categoria.edit', $categoria->id) }}"
                                class="bg-sky-500 hover:bg-sky-700 text-white rounded-sm px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4 border border-gray-800 text-center">
                            <form action="{{ route('categoria.changeState', $categoria->id) }}" method="POST">
                                @csrf
                                @if ($categoria->estado == 1)
                                    <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white rounded-sm px-5 py-1 transition-all cursor-pointer" >
                                        desabilitar</button>
                                @else
                                    <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white rounded-sm px-5 py-1 transition-all cursor-pointer">
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