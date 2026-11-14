@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')
    <div class="flex items-center gap-5 mb-5">
        <div>
            <a href="{{ route('venta.index') }}">
                <x-lucide-chevron-left class="w-6 h-6 text-gris-calido-oscuro hover:text-gris-suave"/>
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

            <div class="dt-container">
                <table class="datatable">
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
                                <td class="p-2">{{ number_format($detalle->subtotal, 2, ',', '.') }}</td>
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
                    <label for=""> ${{ number_format($totales['subtotal'], 2, ',', '.') }}</label>
                    <label for="">${{ number_format($totales['total_impuestos'], 2, ',', '.') }}</label>
                </div>
            </div>

            <hr>    

            <div class="grid grid-cols-2">
                <div class="">
                    <label for="">Total de la factura</label>
                </div>
                <div class="">{{ number_format($factura->total, 2, ',', '.') }}</div>
            </div>
        </div>

        <div class="border border-blanco-calido rounded-lg p-2 
            bg-blanco-calido shadow shadow-gris-calido-claro max-h-80">
            <div class="border border-gray-800 rounded-lg p-2 mb-5">
                <h2 class="">Acciones Rapidas</h2>
                <div class="flex items-center justify-center gap-5 mt-5">
                    <button type="button"
                        onclick="window.print()"
                        class="rounded-lg bg-azul-grisaceo px-4 py-2 text-blanco-calido
                            hover:bg-azul-grisaceo-oscuro">
                        <i class="fa-solid fa-print"></i>
                        Imprimir factura
                    </button>
                    <a href="" class="text-xl text-verde-salvia hover:bg-verde-salvia-claro border
                    border-verde-salvia-claro rounded-sm p-2 hover:text-blanco-calido">
                        <i class="fa-regular fa-paper-plane"></i>
                    </a>
                </div>
            </div>

            <div>
                <h2 class="text-gris-calido-claro font-bold">Estado</h2>
                @if ($factura->estado == 'pagado')
                    <div>
                        <div class="flex gap-4">
                            <i> <x-lucide-check class="h-8 w-8 text-verde-salvia bg-verde-suave/50 rounded-full"/> </i>
                            <p>Pago confirmado</p>
                        </div>
                        <p class="text-gris-calido-claro">
                            {{ $factura->metodo_pago }} - {{ $factura->created_at->format('Y-m-d') }}
                        </p>
                    </div>
                @else
                    <div>
                        <div class="flex gap-4">
                            <i> <x-lucide-x class="h-8 w-8 text-terracota-suave bg-terracota-suave/50 rounded-full"/> </i>
                            <p>Pago no confirmado</p>
                        </div>
                        <p class="text-gris-calido-claro">
                            {{ $factura->metodo_pago }} - {{ $factura->created_at }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection