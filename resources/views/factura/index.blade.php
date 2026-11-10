@extends('layouts.app')

@section('titulo', 'lista de facturas')

@section('content')
    @if (session('success'))
        <div id="success-message" class="bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
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

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>index</th>
                    <th>codigo</th>
                    <th>cliente</th>
                    <th>observaciones</th>
                    <th>estado</th>
                    <th>total</th>
                    <th>ver detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturas as $index => $factura)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $factura->codigo }}</td>
                        <td>{{ $factura->cliente->nombre }}</td>
                        <td>{{ $factura->observaciones }}</td>
                        <td>{{ $factura->estado }}</td>
                        <td>{{ number_format($factura->total, 0, ',', '.') }}</td>
                        <td>
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