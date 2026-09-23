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
              class="bg-verde-salvia hover:bg-verde-salvia text-blanco-calido 
                rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

     <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-6 py-3 font-medium">Id</th>
                    <th class="px-6 py-3 font-medium">Proveedor</th>
                    <th class="px-6 py-3 font-medium">Metodo pago</th>
                    <th class="px-6 py-3 font-medium">Total</th>
                    <th class="px-6 py-3 font-medium">Acciones</th>
                    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                @foreach ($compras as $compra)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $compra->id }}</td>
                        <td class="p-3">{{ $compra->proveedor->nombre }}</td>
                        <td class="p-3">{{ $compra->metodo_pago}}</td>
                        <td class="p-3">{{ $compra->total }}</td>
                        <td class="p-3">
                            <a href="{{ route('compra.edit', $compra->id) }}"
                               class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection