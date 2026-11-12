
@extends('layouts.app')

@section('titulo', 'home')

@section('content')

<div class="mx-auto max-w-7xl space-y-6 p-5">

    {{-- ENCABEZADO --}}
    <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="h-10 w-1 rounded-full bg-[#465D4A]"></div>
            <div>
                <h1 class="text-2xl font-bold text-gris-grafito">
                    Panel principal
                </h1>
                <p class="text-sm text-gray-500">
                    Resumen general del sistema FINIX
                </p>
            </div>
        </div>
    </div>

    {{-- TARJETAS PRINCIPALES --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- UNIDADES EN INVENTARIO --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition hover:shadow-md">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#465D4A] text-white">
                    <i class="fa-solid fa-boxes-stacked text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gris-grafito">
                        Unidades en inventario
                    </p>
                    <p class="text-xs text-gray-500">
                        Existencias actuales
                    </p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-3">
                <p class="text-3xl font-bold text-gris-grafito">
                    {{ number_format($totalUnidades) }}
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Unidades disponibles
                </p>
            </div>
        </div>

        {{-- TOTAL PRODUCTOS --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition hover:shadow-md">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#465D4A] text-white">
                    <i class="fa-solid fa-box text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gris-grafito">
                        Total de productos
                    </p>
                    <p class="text-xs text-gray-500">
                        Inventario registrado
                    </p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-3">
                <p class="text-3xl font-bold text-gris-grafito">
                    {{ number_format($totalProductos) }}
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Productos registrados
                </p>
            </div>
        </div>

        {{-- FACTURAS --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition hover:shadow-md">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#465D4A] text-white">
                    <i class="fa-solid fa-file-invoice text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gris-grafito">
                        Facturas creadas
                    </p>
                    <p class="text-xs text-gray-500">
                        Registro de facturación
                    </p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-3">
                <p class="text-3xl font-bold text-gris-grafito">
                    {{ number_format($totalFacturas) }}
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Facturas registradas
                </p>
            </div>
        </div>

        {{-- VENTAS DE HOY --}}
        <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition hover:shadow-md">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#465D4A] text-white">
                    <i class="fa-solid fa-calendar-day text-lg"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gris-grafito">
                        Ventas de hoy
                    </p>
                    <p class="text-xs text-gray-500">
                        Facturas pagadas
                    </p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-3">
                <p class="text-3xl font-bold text-gris-grafito">
                    ${{ number_format($ventasHoy, 2) }}
                </p>
                <p class="mt-1 text-xs text-gray-500">
                    Total del día
                </p>
            </div>
        </div>

    </div>


    {{-- VENTAS Y FACTURACIÓN --}}
    <div class="space-y-4">

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-7 w-1 rounded-full bg-[#465D4A]"></div>
                <div>
                    <h2 class="text-base font-bold text-gris-grafito">
                        Ventas y facturación
                    </h2>
                    <p class="text-xs text-gray-500">
                        Resumen de ventas y últimas facturas
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">

            {{-- VENTAS POR CATEGORÍA --}}
            <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#465D4A]/10 text-[#465D4A]">
                        <i class="fa-solid fa-tags text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gris-grafito">
                            Ventas por categoría
                        </p>
                        <p class="text-xs text-gray-500">
                            Resumen de ventas
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">

                    @forelse ($ventasCategoria as $v)

                        <div class="flex items-center justify-between gap-3 py-3 text-sm">
                            <span class="truncate text-gris-grafito">
                                {{ $v->nombre }}
                            </span>

                            <span class="shrink-0 font-semibold text-[#465D4A]">
                                ${{ number_format($v->total_ventas, 2) }}
                            </span>
                        </div>

                    @empty

                        <p class="py-5 text-center text-xs text-gray-500">
                            No hay ventas registradas.
                        </p>

                    @endforelse

                </div>
            </div>


            {{-- VENTAS POR DÍA --}}
            <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

                <div class="mb-3 flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#465D4A]/10 text-[#465D4A]">
                        <i class="fa-solid fa-calendar-week text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gris-grafito">
                            Ventas por día
                        </p>
                        <p class="text-xs text-gray-500">
                            Últimos 7 días
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">

                    @forelse ($ventasPorDia as $d)

                        <div class="flex items-center justify-between gap-3 py-3 text-sm">
                            <span class="text-gray-500">
                                {{ \Carbon\Carbon::parse($d->fecha)->format('d/m/Y') }}
                            </span>

                            <span class="font-semibold text-[#465D4A]">
                                ${{ number_format($d->total_dia ?? 0, 2) }}
                            </span>
                        </div>

                    @empty

                        <p class="py-5 text-center text-xs text-gray-500">
                            No hay ventas registradas.
                        </p>

                    @endforelse

                </div>
            </div>


            {{-- FACTURAS RECIENTES --}}
            <div class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

                <div class="mb-3 flex items-center gap-3 border-b border-linea-exterior-tabla pb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#465D4A]/10 text-[#465D4A]">
                        <i class="fa-solid fa-receipt text-lg"></i>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-gris-grafito">
                            Facturas recientes
                        </p>
                        <p class="text-xs text-gray-500">
                            Últimas facturas registradas
                        </p>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">

                    @forelse ($facturasRecientes as $f)

                        <div class="flex items-center justify-between gap-3 py-3">

                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#465D4A]/10 text-[#465D4A]">
                                    <i class="fa-solid fa-file-lines"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gris-grafito">
                                        {{ $f->codigo }}
                                    </p>
                                    <p class="mt-1 truncate text-xs text-gray-500">
                                        {{ $f->cliente ?? 'Sin cliente' }}
                                        · {{ ucfirst($f->estado) }}
                                    </p>
                                </div>
                            </div>

                            <span class="shrink-0 text-sm font-bold text-[#465D4A]">
                                ${{ number_format($f->total, 2) }}
                            </span>

                        </div>

                    @empty

                        <p class="py-5 text-center text-xs text-gray-500">
                            No hay facturas registradas.
                        </p>

                    @endforelse

                </div>
            </div>

        </div>
    </div>


    {{-- CONTROL DE INVENTARIO --}}
    <div class="space-y-4">

        <div class="flex items-center gap-3">
            <div class="h-7 w-1 rounded-full bg-[#465D4A]"></div>

            <div>
                <h2 class="text-base font-bold text-gris-grafito">
                    Control de inventario
                </h2>
                <p class="text-xs text-gray-500">
                    Alertas y seguimiento de los productos
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 items-start gap-4 md:grid-cols-2 xl:grid-cols-3">

            <div class="min-w-0">
                <livewire:alerta-stock />
            </div>

            <div class="min-w-0">
                <livewire:producto-mas-vendido />
            </div>

            <div class="min-w-0 md:col-span-2 xl:col-span-1">
                <livewire:producto-por-vencer />
            </div>

        </div>
    </div>

</div>

@endsection
