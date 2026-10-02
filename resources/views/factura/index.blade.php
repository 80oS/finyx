@extends('layouts.app')

@section('titulo', 'lista de facturas')

@section('content')
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Ventas
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('venta.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido 
                rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-3 py-3 font-medium">id</th>
                    <th class="px-3 py-3 font-medium">codigo</th>
                    <th class="px-3 py-3 font-medium">cliente</th>
                    <th class="px-3 py-3 font-medium">observaciones</th>
                    <th class="px-3 py-3 font-medium">estado</th>
                    <th class="px-3 py-3 font-medium">total</th>
                    <th class="px-3 py-3 font-medium">editar</th>
                    <th class="px-3 py-3 font-medium">ver detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $factura)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $factura->id }}</td>
                        <td class="p-3">{{ $factura->codigo }}</td>
                        <td class="p-3">{{ $factura->cliente->nombre }}</td>
                        <td class="p-3">{{ $factura->observaciones }}</td>
                        <td class="p-3">{{ $factura->estado }}</td>
                        <td class="p-3">{{ $factura->total }}</td>
                        <td class="p-3">
                            <a href="" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('venta.show', $factura->id) }}" 
                                class="text-ambar-claro hover:text-ambar-oscuro p-1 text-base">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection