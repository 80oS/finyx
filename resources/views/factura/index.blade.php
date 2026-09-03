@extends('layout.app')

@section('titulo', 'lista de facturas')

@section('content')
    @if (session('success'))
        <div class=" bg-green-700/10 border border-green-400 text-gray-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Ventas
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('venta.create') }}" 
            class="bg-green-700 hover:bg-green-900 text-white rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <tr>
                    <th class="px-3 py-3 font-medium border border-gray-800">id</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">codigo</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">cliente</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">observaciones</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">estado</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">total</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">editar</th>
                    <th class="px-3 py-3 font-medium border border-gray-800">ver detalle</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                    @foreach ($facturas as $factura)
                        <td class="p-3 border border-gray-800">{{ $factura->id }}</td>
                        <td class="p-3 border border-gray-800">{{ $factura->codigo }}</td>
                        <td class="p-3 border border-gray-800">{{ $factura->cliente->nombre }}</td>
                        <td class="p-3 border border-gray-800">{{ $factura->observaciones }}</td>
                        <td class="p-3 border border-gray-800">{{ $factura->estado }}</td>
                        <td class="p-3 border border-gray-800">{{ $factura->total }}</td>
                        <td class="p-3 border border-gray-800">
                            <a href="" class="bg-gray-300 text-indigo-700 hover:text-indigo-900 p-1">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="p-3 border border-gray-800">
                            <a href="" class="bg-gray-300 text-emerald-700 hover:text-emerald-900 p-1">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection