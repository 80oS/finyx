@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')

<div class="mb-6 flex items-center gap-4 print:hidden">
    <a href="{{ route('venta.index') }}"
        class="rounded-lg p-2 transition hover:bg-ambar-suave/30">
        <x-lucide-chevron-left class="h-6 w-6 text-gris-calido-oscuro"/>
    </a>

    <div>
        <label class="text-xs font-bold uppercase tracking-wider text-gris-suave">
            Facturación
        </label>
        <h1 class="text-xl font-bold text-gris-calido-oscuro">
            Detalle de Factura
        </h1>
    </div>
</div>

<div class="grid grid-cols-1 items-start gap-5 lg:grid-cols-[minmax(0,2.3fr)_minmax(260px,0.9fr)] print:block">


    <div id="factura-print"
        class="rounded-xl border border-blanco-calido bg-blanco-calido p-5 shadow-sm sm:p-7
        print:w-full print:border-0 print:p-0 print:shadow-none">

    
        <div class="mb-7 flex flex-wrap items-center justify-between gap-4 border-b border-gris-suave/70 pb-6">

            <div class="flex items-center gap-4">

                <div class="rounded-xl bg-ambar-suave/40 p-3">
                    <x-lucide-file-text class="h-9 w-9 text-ambar-claro"/>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gris-suave">
                        Factura de venta
                    </p>

                    <h2 class="mt-1 text-2xl font-bold tracking-wide text-gris-calido-oscuro">
                        FINYX
                    </h2>

                    <p class="mt-1 text-xs text-gris-suave">
                        Sistema de facturación e inventario
                    </p>
                </div>

            </div>

            <div class="min-w-[130px] text-right">
                <p class="text-xs font-medium text-gris-suave">
                    Número de factura
                </p>

                <h2 class="mt-1 text-xl font-bold text-gris-calido-oscuro">
                    {{ $factura->codigo }}
                </h2>

                <span class="mt-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold
                    {{ $factura->estado == 'pagado'
                        ? 'bg-verde-suave/50 text-verde-salvia-claro'
                        : 'bg-terracota-suave/50 text-terracota-suave' }}">
                    {{ ucfirst($factura->estado) }}
                </span>
            </div>

        </div>

        
        <div class="mb-7 grid grid-cols-1 gap-6 border-b border-gris-suave/70 pb-6 sm:grid-cols-3">

            <div>
                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gris-suave">
                    Facturado a
                </h3>

                <p class="font-semibold text-gris-calido-oscuro">
                    {{ $factura->cliente->nombre }}
                </p>

                <p class="mt-2 text-sm text-gris-calido-oscuro">
                    <span class="font-semibold">Cédula:</span>
                    {{ $factura->cliente->cedula }}
                </p>

                <p class="mt-1 text-sm text-gris-calido-oscuro">
                    <span class="font-semibold">Dirección:</span>
                    {{ $factura->cliente->direccion }}
                </p>
            </div>

            <div>
                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gris-suave">
                    Fecha de creación
                </h3>

                <p class="font-semibold text-gris-calido-oscuro">
                    {{ $factura->created_at->format('d/m/Y') }}
                </p>

                <p class="mt-1 text-sm text-gris-suave">
                    {{ $factura->created_at->format('h:i A') }}
                </p>
            </div>

            <div>
                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gris-suave">
                    Método de pago
                </h3>

                <div class="flex items-center gap-2">
                    <p class="font-semibold capitalize text-gris-calido-oscuro">
                        {{ $factura->metodo_pago }}
                    </p>
                </div>
            </div>

        </div>

    
        <div class="mb-7">

            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-sm font-bold uppercase tracking-wide text-gris-calido-oscuro">
                    Detalle de productos
                </h3>

                <span class="text-xs text-gris-suave">
                    {{ $factura->detalleFactura->count() }} productos
                </span>
            </div>

            <div class="w-full overflow-x-auto rounded-lg border border-gris-suave/50">

                <table id="tabla-factura" class="datatable w-full text-sm">

                    <thead class="bg-ambar-suave/20">
                        <tr>
                            <th class="px-4 py-4 text-left font-semibold text-gris-calido-oscuro">
                                Producto
                            </th>

                            <th class="px-4 py-4 text-center font-semibold text-gris-calido-oscuro">
                                Código
                            </th>

                            <th class="px-4 py-4 text-right font-semibold text-gris-calido-oscuro whitespace-nowrap">
                                Precio unitario
                            </th>

                            <th class="px-4 py-4 text-center font-semibold text-gris-calido-oscuro">
                                Cantidad
                            </th>

                            <th class="px-4 py-4 text-right font-semibold text-gris-calido-oscuro">
                                Subtotal
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($factura->detalleFactura as $detalle)
                            <tr class="border-t border-gris-suave/40 transition hover:bg-ambar-suave/10">

                                <td class="px-4 py-4 font-medium text-gris-calido-oscuro">
                                    {{ $detalle->producto->nombre }}
                                </td>

                                <td class="px-4 py-4 text-center text-gris-suave">
                                    {{ $detalle->producto->codigo }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-right text-gris-calido-oscuro">
                                    ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-4 text-center text-gris-calido-oscuro">
                                    {{ $detalle->cantidad }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-right font-semibold text-gris-calido-oscuro">
                                    ${{ number_format($detalle->subtotal, 2, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

        
        <div class="ml-auto max-w-sm">

            <div class="flex justify-between border-b border-gris-suave/60 py-3">
                <span class="text-sm text-gris-suave">
                    Subtotal
                </span>

                <span class="font-medium text-gris-calido-oscuro">
                    ${{ number_format($totales['subtotal'], 2, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between border-b border-gris-suave/60 py-3">
                <span class="text-sm text-gris-suave">
                    IVA / Impuestos
                </span>

                <span class="font-medium text-gris-calido-oscuro">
                    ${{ number_format($totales['total_impuestos'], 2, ',', '.') }}
                </span>
            </div>

            <div class="mt-4 rounded-xl border border-verde-suave/40 bg-verde-salvia/10 p-4">

                <div class="flex items-center justify-between gap-3">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-gris-suave">
                            Total a pagar
                        </p>

                        <p class="mt-1 text-xs text-gris-suave">
                            Valor final de la factura
                        </p>
                    </div>

                    <span class="text-xl font-bold text-gris-calido-oscuro">
                        ${{ number_format($factura->total, 2, ',', '.') }}
                    </span>

                </div>
            </div>

        </div>

        <div class="mt-10 border-t border-gris-suave/70 pt-6 text-center">

            <p class="font-semibold text-gris-calido-oscuro">
                ¡Gracias por tu compra!
            </p>

            <p class="mt-1 text-xs text-gris-suave">
                FINYX - Sistema de facturación e inventario
            </p>

        </div>

    </div>


    
    <div class="space-y-4 print:hidden">

    
        <div class="rounded-xl border border-blanco-calido bg-blanco-calido p-5 shadow-sm">

            <div class="mb-4 flex items-center gap-2">
                
                <h2 class="font-bold text-gris-calido-oscuro">
                    Acciones rápidas
                </h2>
            </div>

            <p class="mb-4 text-sm text-gris-suave">
                Puedes imprimir una copia de esta factura.
            </p>

            <button type="button"
                onclick="window.print()"
                class="flex w-full items-center justify-center gap-2 rounded-lg bg-azul-grisaceo px-4 py-3 text-sm font-semibold text-blanco-calido shadow-sm transition hover:bg-azul-grisaceo-oscuro">

                <x-lucide-printer class="h-4 w-4"/>
                Imprimir factura

            </button>

        </div>

        <div class="rounded-xl border border-blanco-calido bg-blanco-calido p-5 shadow-sm">

            <h2 class="mb-5 font-bold text-gris-calido-oscuro">
                Estado de la factura
            </h2>

            @if ($factura->estado == 'pagado')

                <div class="flex items-center gap-3">

                    <div class="rounded-full bg-verde-suave/50 p-2">
                        <x-lucide-check class="h-5 w-5 text-verde-salvia"/>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gris-calido-oscuro">
                            Pago confirmado
                        </p>

                        <p class="mt-1 text-xs text-gris-suave">
                            La factura se encuentra pagada.
                        </p>
                    </div>

                </div>

            @else

                <div class="flex items-center gap-3">

                    <div class="rounded-full bg-terracota-suave/50 p-2">
                        <x-lucide-x class="h-5 w-5 text-terracota-suave"/>
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-gris-calido-oscuro">
                            Pago no confirmado
                        </p>

                        <p class="mt-1 text-xs text-gris-suave">
                            La factura está pendiente de pago.
                        </p>
                    </div>

                </div>

            @endif

            <div class="mt-5 border-t border-gris-suave/50 pt-4">

                <p class="text-xs text-gris-suave">
                    Método de pago
                </p>

                <p class="mt-1 text-sm font-semibold capitalize text-gris-calido-oscuro">
                    {{ $factura->metodo_pago }}
                </p>

                <p class="mt-3 text-xs text-gris-suave">
                    Fecha de emisión
                </p>

                <p class="mt-1 text-sm font-semibold text-gris-calido-oscuro">
                    {{ $factura->created_at->format('d/m/Y') }}
                </p>

            </div>

        </div>

    </div>

</div>

<style>
    @media print {

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        html,
        body {
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: visible !important;
        }

        body * {
            visibility: hidden !important;
        }

        #factura-print,
        #factura-print * {
            visibility: visible !important;
        }

        #factura-print {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: white !important;
        }

        .min-h-screen,
        main {
            min-height: 0 !important;
            height: auto !important;
            overflow: visible !important;
        }

        .dt-search,
        .dt-length,
        .dt-info,
        .dt-paging,
        .dataTables_filter,
        .dataTables_length,
        .dataTables_info,
        .dataTables_paginate {
            display: none !important;
        }

        #tabla-factura {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 10px !important;
        }

        #tabla-factura th,
        #tabla-factura td {
            padding: 7px 5px !important;
        }

        #tabla-factura thead {
            display: table-header-group !important;
        }

        #tabla-factura tr {
            break-inside: avoid !important;
            page-break-inside: avoid !important;
        }

        .ml-auto {
            break-inside: avoid !important;
            page-break-inside: avoid !important;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

@endsection