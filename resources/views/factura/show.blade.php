@extends('layouts.app')

@section('titulo', 'Detalle Factura')

@section('content')

<div class="mb-6 flex items-center gap-4 print:hidden">
    <a href="{{ route('venta.index') }}"
        class="rounded-xl border border-linea-input bg-blanco-calido p-2.5 text-gris-calido-oscuro shadow-sm transition duration-200 hover:border-ambar-claro hover:bg-ambar-suave/30">
        <x-lucide-chevron-left class="h-5 w-5" />
    </a>

    <div>
        <label class="text-xs font-bold uppercase tracking-[0.15em] text-gris-calido-claro">
            Facturación
        </label>
        <h1 class="mt-0.5 text-2xl font-bold tracking-tight text-gris-calido-oscuro">
            Detalle de factura
        </h1>
    </div>
</div>

<div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-[minmax(0,2.3fr)_minmax(280px,0.9fr)] print:block">

    {{-- FACTURA --}}
    <div id="factura-print"
        class="overflow-hidden rounded-2xl border border-linea-exterior-tabla bg-blanco-calido shadow-sm print:w-full print:rounded-none print:border-0 print:p-0 print:shadow-none">

        <div class="p-5 sm:p-8">

            {{-- ENCABEZADO --}}
            <div class="mb-8 flex flex-wrap items-center justify-between gap-5 border-b border-linea-input pb-7">

                <div class="flex items-center gap-4">
                    <div class="rounded-2xl bg-ambar-suave/40 p-3.5">
                        <x-lucide-file-text class="h-8 w-8 text-ambar-claro" />
                    </div>

                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-gris-calido-claro">
                            Factura de venta
                        </p>

                        <h2 class="mt-1 text-3xl font-extrabold tracking-wide text-gris-calido-oscuro">
                            FINYX
                        </h2>

                        <p class="mt-1 text-xs text-gris-calido-claro">
                            Sistema de facturación e inventario
                        </p>
                    </div>
                </div>

                <div class="min-w-36 text-right">
                    <p class="text-xs font-medium text-gris-calido-claro">
                        Número de factura
                    </p>

                    <h2 class="mt-1 break-all text-xl font-bold text-gris-calido-oscuro">
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

            {{-- INFORMACIÓN GENERAL --}}
            <div class="mb-8 grid grid-cols-1 gap-6 border-b border-linea-input pb-7 sm:grid-cols-2 xl:grid-cols-3">

                <div class="min-w-0">
                    <h3 class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gris-calido-claro">
                        <x-lucide-user class="h-4 w-4" />
                        Facturado a
                    </h3>

                    <p class="wrap-break-word font-semibold text-gris-calido-oscuro">
                        {{ $factura->cliente->nombre }}
                    </p>

                    <p class="mt-2 wrap-break-word text-sm text-gris-calido-oscuro">
                        <span class="font-semibold">Cédula:</span>
                        {{ $factura->cliente->cedula }}
                    </p>

                    <p class="mt-1 wrap-break-word text-sm text-gris-calido-oscuro">
                        <span class="font-semibold">Dirección:</span>
                        {{ $factura->cliente->direccion }}
                    </p>
                </div>

                <div>
                    <h3 class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gris-calido-claro">
                        <x-lucide-calendar-days class="h-4 w-4" />
                        Fecha de creación
                    </h3>

                    <p class="font-semibold text-gris-calido-oscuro">
                        {{ $factura->created_at->format('d/m/Y') }}
                    </p>

                    <p class="mt-1 text-sm text-gris-calido-claro">
                        {{ $factura->created_at->format('h:i A') }}
                    </p>
                </div>

                <div>
                    <h3 class="mb-3 flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-gris-calido-claro">
                        <x-lucide-wallet class="h-4 w-4" />
                        Método de pago
                    </h3>

                    <p class="font-semibold capitalize text-gris-calido-oscuro">
                        {{ $factura->metodo_pago }}
                    </p>
                </div>

            </div>

            {{-- PRODUCTOS --}}
            <div class="mb-8">

                <div class="mb-4 flex flex-wrap items-center justify-between gap-2">
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-gris-calido-oscuro">
                            Detalle de productos
                        </h3>
                        <p class="mt-1 text-xs text-gris-calido-claro">
                            Productos incluidos en esta factura
                        </p>
                    </div>

                    <span class="rounded-lg bg-lino-natural px-3 py-1.5 text-xs font-semibold text-gris-calido-oscuro">
                        {{ $factura->detalleFactura->count() }} productos
                    </span>
                </div>

                <div class="w-full overflow-x-auto p-3">
                    <table class="w-full text-sm">

                        <thead class="bg-lino-natural">
                            <tr>
                                <th
                                    class="whitespace-nowrap px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Index
                                </th>
                                <th
                                    class="whitespace-nowrap px-4 py-4 text-left text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Producto
                                </th>

                                <th
                                    class="whitespace-nowrap px-4 py-4 text-center text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Código
                                </th>

                                <th
                                    class="whitespace-nowrap px-4 py-4 text-right text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Precio unitario
                                </th>

                                <th
                                    class="whitespace-nowrap px-4 py-4 text-center text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Cantidad
                                </th>

                                <th
                                    class="whitespace-nowrap px-4 py-4 text-right text-xs font-bold uppercase tracking-wide text-gris-calido-oscuro">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($factura->detalleFactura as $index => $detalle)
                            <tr class="border-t border-linea-input transition-colors hover:bg-lino-natural/60">

                                <td class="px-4 py-4 font-semibold text-gris-calido-oscuro">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-gris-calido-oscuro">
                                    {{ $detalle->producto->nombre }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-center text-xs text-gris-calido-claro">
                                    {{ $detalle->producto->codigo }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-4 text-right tabular-nums text-gris-calido-oscuro">
                                    ${{ number_format($detalle->precio_unitario, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-4 text-center font-medium text-gris-calido-oscuro">
                                    {{ $detalle->cantidad }}
                                </td>

                                <td
                                    class="whitespace-nowrap px-4 py-4 text-right font-bold tabular-nums text-gris-calido-oscuro">
                                    ${{ number_format($detalle->subtotal, 2, ',', '.') }}
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            {{-- TOTALES --}}
            <div class="ml-auto w-full max-w-sm">

                <div class="flex items-center justify-between gap-4 border-b border-linea-input py-3">
                    <span class="text-sm text-gris-calido-claro">
                        Subtotal
                    </span>

                    <span class="font-semibold tabular-nums text-gris-calido-oscuro">
                        ${{ number_format($totales['subtotal'], 2, ',', '.') }}
                    </span>
                </div>

                <div class="flex items-center justify-between gap-4 border-b border-linea-input py-3">
                    <span class="text-sm text-gris-calido-claro">
                        IVA / Impuestos
                    </span>

                    <span class="font-semibold tabular-nums text-gris-calido-oscuro">
                        ${{ number_format($totales['total_impuestos'], 2, ',', '.') }}
                    </span>
                </div>

                <div class="mt-4 rounded-xl border border-verde-suave/40 bg-verde-salvia/10 p-4">
                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gris-calido-claro">
                                Total a pagar
                            </p>

                        </div>

                        <span class="text-xl font-extrabold tabular-nums text-gris-calido-oscuro">
                            ${{ number_format($factura->total, 2, ',', '.') }}
                        </span>

                    </div>
                </div>

            </div>

            {{-- PIE DE FACTURA --}}
            <div class="mt-10 border-t border-linea-input pt-7 text-center">
                <p class="font-bold text-gris-calido-oscuro">
                    ¡Gracias por tu compra!
                </p>

                <p class="mt-1 text-xs text-gris-calido-claro">
                    FINYX - Sistema de facturación e inventario
                </p>
            </div>

        </div>
    </div>

    {{-- PANEL LATERAL --}}
    <div class="space-y-5 print:hidden">

        {{-- ACCIONES --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-5 shadow-sm">

            <div class="mb-4 flex items-center gap-2">
                <div class="rounded-lg bg-ambar-suave/30 p-2">
                    <x-lucide-zap class="h-4 w-4 text-ambar-claro" />
                </div>

                <h2 class="font-bold text-gris-calido-oscuro">
                    Acciones rápidas
                </h2>
            </div>

            <p class="mb-5 text-sm leading-relaxed text-gris-calido-claro">
                Puedes imprimir una copia de esta factura para conservarla o entregarla al cliente.
            </p>

            <button type="button" onclick="window.print()"
                class="flex w-full  cursor-pointer items-center justify-center gap-2 rounded-xl bg-azul-grisaceo px-4 py-3 text-sm font-semibold text-blanco-calido shadow-sm transition duration-200 hover:bg-azul-grisaceo-oscuro hover:shadow-md active:scale-[0.98]">

                <x-lucide-printer class="h-4 w-4" />
                Imprimir factura

            </button>

        </div>

        {{-- ESTADO --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-5 shadow-sm">

            <h2 class="mb-5 flex items-center gap-2 font-bold text-gris-calido-oscuro">
                <x-lucide-clipboard-check class="h-5 w-5 text-gris-calido-claro" />
                Estado de la factura
            </h2>

            @if ($factura->estado == 'pagado')

            <div class="flex items-start gap-3">
                <div class="shrink-0 rounded-xl bg-verde-suave/50 p-2.5">
                    <x-lucide-check class="h-5 w-5 text-verde-salvia" />
                </div>

                <div>
                    <p class="text-sm font-bold text-gris-calido-oscuro">
                        Pago confirmado
                    </p>

                    <p class="mt-1 text-xs leading-relaxed text-gris-calido-claro">
                        La factura se encuentra pagada.
                    </p>
                </div>
            </div>

            @else

            <div class="flex items-start gap-3">
                <div class="shrink-0 rounded-xl bg-terracota-suave/50 p-2.5">
                    <x-lucide-x class="h-5 w-5 text-terracota-suave" />
                </div>

                <div>
                    <p class="text-sm font-bold text-gris-calido-oscuro">
                        Pago no confirmado
                    </p>

                    <p class="mt-1 text-xs leading-relaxed text-gris-calido-claro">
                        La factura está pendiente de pago.
                    </p>
                </div>
            </div>

            @endif

            <div class="mt-5 space-y-4 border-t border-linea-input pt-5">

                <div>
                    <p class="text-xs text-gris-calido-claro">
                        Método de pago
                    </p>

                    <p class="mt-1 text-sm font-semibold capitalize text-gris-calido-oscuro">
                        {{ $factura->metodo_pago }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-gris-calido-claro">
                        Fecha de emisión
                    </p>

                    <p class="mt-1 text-sm font-semibold text-gris-calido-oscuro">
                        {{ $factura->created_at->format('d/m/Y') }}
                    </p>
                </div>

            </div>

        </div>

        <div class="ml-auto w-full max-w-sm border border-gris-suave/50 rounded-lg p-3 bg-blanco-calido">
        
            <h2 class="font-semibold text-gris-calido-oscuro text-center">Resumen</h2>
        
            <div class="flex items-center justify-between gap-4 border-b border-linea-input py-3">
                <span class="text-sm text-gris-calido-claro">
                    Subtotal
                </span>
        
                <span class="font-semibold tabular-nums text-gris-calido-oscuro">
                    ${{ number_format($totales['subtotal'], 2, ',', '.') }}
                </span>
            </div>
        
            <div class="flex items-center justify-between gap-4 border-b border-linea-input py-3">
                <span class="text-sm text-gris-calido-claro">
                    IVA / Impuestos
                </span>
        
                <span class="font-semibold tabular-nums text-gris-calido-oscuro">
                    ${{ number_format($totales['total_impuestos'], 2, ',', '.') }}
                </span>
            </div>
        
            <div class="mt-4 rounded-xl border border-verde-suave/40 bg-verde-salvia/10 p-4">
                <div class="flex items-center justify-between gap-4">
        
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gris-calido-claro">
                            Total a pagar
                        </p>
                    </div>
        
                    <span class="text-xl font-extrabold tabular-nums text-gris-calido-oscuro">
                        ${{ number_format($factura->total, 2, ',', '.') }}
                    </span>
        
                </div>
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
            overflow: visible !important;
        }

        .min-h-screen,
        main,
        #factura-print .overflow-x-auto,
        #factura-print .dataTables_wrapper,
        #factura-print .dt-container,
        #factura-print .dt-layout-row,
        #factura-print .dt-layout-cell {
            width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            max-height: none !important;
            overflow: visible !important;
        }

        /* Ocultar controles de DataTables */
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

        /* Mostrar todas las filas de la tabla */
        #tabla-factura,
        #tabla-factura tbody,
        #tabla-factura thead {
            display: table !important;
            width: 100% !important;
        }

        #tabla-factura {
            border-collapse: collapse !important;
            table-layout: auto !important;
            font-size: 10px !important;
        }

        #tabla-factura tbody tr,
        #tabla-factura tbody tr[style],
        #tabla-factura tbody tr.dtr-hidden {
            display: table-row !important;
            visibility: visible !important;
        }

        #tabla-factura th,
        #tabla-factura td {
            display: table-cell !important;
            padding: 7px 5px !important;
        }

        #tabla-factura thead {
            display: table-header-group !important;
        }

        #tabla-factura tbody {
            display: table-row-group !important;
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