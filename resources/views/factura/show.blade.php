@extends('layout.app')

@section('titulo', 'Detalle Factura')

@section('content')

    <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
        Venta {{ $factura->codigo }}
    </div>
    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <tr>
                    <th class="px-6 py-3 font-medium border border-gray-800 capitalize">codigo</th>
                    <th class="px-6 py-3 font-medium border border-gray-800 capitalize">nombre</th>
                    <th class="px-6 py-3 font-medium border border-gray-800 capitalize">cantidad</th>
                    <th class="px-6 py-3 font-medium border border-gray-800 capitalize">precio_unitario</th>
                    <th class="px-6 py-3 font-medium border border-gray-800 capitalize">subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                @foreach ($factura->detalleFactura as $detalle)
                    <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                        <td class="p-3 border border-gray-800">{{ $detalle->producto->codigo }}</td>
                        <td class="p-3 border border-gray-800">{{ $detalle->producto->nombre }}</td>
                        <td class="p-3 border border-gray-800">{{ $detalle->cantidad }}</td>
                        <td class="p-3 border border-gray-800">{{ $detalle->precio_unitario }}</td>
                        <td class="p-3 border border-gray-800">{{ $detalle->subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfooter>
                <tr>
                    <td class="p-3 border border-gray-800">Total</td>
                    <td class="p-3 border border-gray-800">{{ $factura->total }}</td>
                </tr>
            </tfooter>
        </table>
    </div>
@endsection