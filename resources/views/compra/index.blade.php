@extends('layout.app')

@section('titulo', 'Lista de Compras')

@section('content')

    @if (session('success'))
        <div class=" bg-green-700/10 border border-green-400 text-gray-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Compras
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('compra.create') }}" 
            class="bg-green-700 hover:bg-green-900 text-white rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <tr>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Id</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Proveedor</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Metodo pago</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Total</th>
                    <th class="px-6 py-3 font-medium border border-gray-800" scope="col">Acciones</th>
                    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                @foreach ($compras as $compra)
                    <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                        <td class="p-3 border border-gray-800">{{ $compra->id }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $compra->proveedor->nombre }}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $compra->metodo_pago}}</td>
                        <td class="px-6 py-4 border border-gray-800">{{ $compra->total }}</td>
                        <td class="px-6 py-4 border border-gray-800 text-center">
                            <a href="{{ route('compra.edit', $compra->id) }}"
                                class="bg-sky-500 hover:bg-sky-700 text-white rounded-sm px-5 py-1 transition-all">
                                Editar</a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection