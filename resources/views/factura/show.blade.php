@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')
    <div class="flex items-center gap-5 mb-5">
        <div>
            <a href="{{ route('venta.index') }}">
                <x-lucide-chevron-left class="w-6 h-6 text-gris-calido-oscuro"/>
            </a>
        </div>
        <div>
            <label for="" class="uppercase text-gris-suave font-bold text-sm">Facturacion</label>
            <h1 class="capitalize text-gris-calido-oscuro font-bold text-lg">Detalle de Factura</h1>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-5">
        <div class="border border-blanco-calido rounded-lg p-2 
                col-span-2 bg-blanco-calido shadow shadow-gris-calido-claro">

            <div class="grid grid-cols-2 mb-3 border-b border-gris-suave pb-5">
                <div class="flex gap-5">
                    <div>
                        <i><x-lucide-file-text class="w-10 h-10 text-ambar-claro bg-ambar-suave/50 p-2 rounded-lg"/></i>
                    </div>
                    <div>
                        <h3 class="capitalize text-gris-suave text-sm">Factura de venta</h3>
                        <p class="capitalize text-gris-calido-oscuro font-bold text-lg">Empresa</p>
                    </div>
                </div>
                <div class="text-end">
                    <h3 class="capitalize text-gris-suave text-sm">Numero de Factura</h3>
                    <span class="text-gris-calido-oscuro txext-lg">{{ $factura->codigo }}</span>
                </div>
            </div>

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