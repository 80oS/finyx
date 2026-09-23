@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')
    <div class="grid grid-cols-2 gap-5">
        <div class="border border-gray-800 rounded-lg p-3">
            <div class="grid grid-cols-2">
                <div class="">
                    <h1>Factura de venta</h1>
                    <p>Empresa</p>
                </div>
                <div class="">
                    <h2>Numero de Factura</h2>
                    {{ $factura->codigo }}
                </div>
            </div>

            <hr>

            <div class="grid grid-cols-3">
                <div class="">
                    <label for="">facturado a</label>
                    <h1>{{ $factura->cliente->nombre }}</h1>
                    <ul>
                        <li>{{ $factura->cliente->cedula }}</li>
                        <li>{{ $factura->cliente->direccion }}</li>
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

            <hr>

            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factura->detalleFactura as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->producto->codigo }}</td>
                                <td>{{ $detalle->precio_unitario }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>{{ $detalle->subtotal }}</td>
                            </tr>

                            <?php
                                $subtotal = $detalle->subtotal
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

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
            <div class="border border-gray-800 rounded-lg p-3 mb-5">
                <table>
                    <thead>
                        <tr>
                            <th>Resumen</th>
                            <th>{{ $factura->estado }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>productos</td>
                            <td>total productos</td>
                        </tr>
                        <tr>
                            <td>unidades</td>
                            <td>total de cantidad</td>
                        </tr>
                        <tr>
                            <td>importe total</td>
                            <td>total con iva</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="border border-gray-800 rounded-lg p-3 mb-5">
                <h1>Acciones Rapidas</h1>
                <a href="">imprimir factura</a>
                <a href="">Enviar por correo</a>
            </div>
        </div>
    </div>

@endsection