@extends('layout.app')

@section('titulo', 'Lista de Categorias')

@section('content')

    @if (session('success'))
        <div class=" bg-green-700/15 border border-green-400 text-slate-400 px-4 py-3 rounded mb-4">
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
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Editar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-200">
                @foreach ($categorias as $categoria)
                    <tr class="bg-gray-900 hover:bg-gray-700 transition-all">
                        <td class="p-3 border border-gray-800">{{ $categoria->id }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $categoria->descripcion }}</td>
                        <td class="px-6 py-4 border border-gray-800 text-center">
                            <a href="{{ route('categoria.edit', $categoria->id) }}"
                                class="bg-sky-700 hover:bg-sky-900 rounded-sm px-5 py-1">
                                Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection