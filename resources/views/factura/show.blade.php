@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')
    <div class="mb-3">
        <a href="{{ route('venta.index') }}"
        class=" bg-ambar-claro hover:bg-ambar-oscuro text-blanco-calido rounded-sm p-2"
        >volver</a>
    </div>
    <div class="grid grid-cols-3 gap-5">
        <div class="border border-gray-800 rounded-lg p-2 col-span-2">

            <div class="grid grid-cols-2 mb-3">
                <div class="">
                    <h1>Factura de venta</h1>
                    <p>Empresa</p>
                </div>
                <div class="text-end">
                    <h2>Numero de Factura</h2>
                    {{ $factura->codigo }}
                </div>
            </div>

            <hr>

            <div class="grid grid-cols-3 mb-3">
                <div class="">
                    <label for="">facturado a</label>
                    <h1>Cliente: {{ $factura->cliente->nombre }}</h1>
                    <ul>
                        <li>Cedula: {{ $factura->cliente->cedula }}</li>
                        <li>Direccion: {{ $factura->cliente->direccion }}</li>
                    </ul>
                </div>
                <div class="">
                    <label for="">Fecha de creacion</label>
                    <h2>{{ $factura->created_at }}</h2>
                </div>
                <div class="">
                    <label for="">Metodo de pago</label>
                    <h2>{{ $factura->metodo_pago }}</h2>
                </div>
            </div>

            <div class="">
                <table class="w-full text-left border-collapse border border-gris-calido-oscuro">
                    <thead class="">
                        <tr>
                            <th class="px-3">Producto</th>
                            <th class="px-3">Codigo</th>
                            <th class="px-3">Precio Unitario</th>
                            <th class="px-3">Cantidad</th>
                            <th class="px-3">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factura->detalleFactura as $detalle)
                            <tr class="">
                                <td class="p-2">{{ $detalle->producto->nombre }}</td>
                                <td class="p-2">{{ $detalle->producto->codigo }}</td>
                                <td class="p-2">{{ $detalle->precio_unitario }}</td>
                                <td class="p-2">{{ $detalle->cantidad }}</td>
                                <td class="p-2">{{ $detalle->subtotal }}</td>
                            </tr>

                            <?php
                                $subtotal = $factura->total
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-2">
                <div class="grid grid-cols-1">
                    <label for="">subtotal</label>
                    <label for="">iva</label>
                </div>
                <div class="grid grid-cols-1">
                    <label for="">{{ $subtotal }}</label>
                    <label for="">subtotal * iva</label>
                </div>
            </div>

            <hr>

            <div class="grid grid-cols-2">
                <div class="">
                    <label for="">Total de la factura</label>
                </div>
                <div class="">{{ $factura->total }}</div>
            </div>
        </div>

        <div class="">
            <div class="border border-gray-800 rounded-lg p-2 mb-5">
                <h1 class="text-center">Acciones Rapidas</h1>
                <div class="flex items-center justify-center gap-5 mt-5">
                    <a href="" class="text-xl text-azul-grisaceo hover:bg-azul-grisaceo-oscuro border
                    border-azul-grisaceo-oscuro rounded-sm p-2 hover:text-blanco-calido">
                        <i class="fa-solid fa-print"></i>
                    </a>
                    <a href="" class="text-xl text-verde-salvia hover:bg-verde-salvia-claro border
                    border-verde-salvia-claro rounded-sm p-2 hover:text-blanco-calido">
                        <i class="fa-regular fa-paper-plane"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection