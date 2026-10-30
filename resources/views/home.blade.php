@extends('layouts.app')

@section('titulo', 'home')

@section('content')

<div class="mx-auto max-w-7xl space-y-8 p-5">
    <div class="grid grid-cols-1 items-stretch gap-5 md:grid-cols-2 xl:grid-cols-3">

        <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition duration-200 hover:shadow-md">

            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gris-calido-claro text-white">
                    <i class="fa-solid fa-boxes-stacked text-lg"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Total de productos</p>
                    <p class="text-xs text-gray-500">Inventario registrado</p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-4">
                <p class="text-3xl font-bold text-gris-grafito">{{ number_format($totalProductos) }}</p>
                <p class="mt-1 text-xs text-gris-grafito">Productos registrados</p>
            </div>

        </div>

        
        <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition duration-200 hover:shadow-md">

            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gris-calido-claro text-white">
                    <i class="fa-solid fa-file-invoice text-lg"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Total de facturas</p>
                    <p class="text-xs text-gray-500">Registro de facturación</p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-4">
                <p class="text-3xl font-bold text-gris-grafito">{{ number_format($totalFacturas) }}</p>
                <p class="mt-1 text-xs text-gris-grafito">Facturas creadas</p>
            </div>

        </div>

        <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition duration-200 hover:shadow-md md:col-span-2 xl:col-span-1">

            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gris-calido-claro text-white">
                    <i class="fa-solid fa-calendar-day text-lg"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Ventas de hoy</p>
                    <p class="text-xs text-gray-500">Facturas pagadas</p>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-this px-4 py-4">
                <p class="text-3xl font-bold text-gris-grafito">${{ number_format($ventasHoy, 2) }}</p>
                <p class="mt-1 text-xs text-gris-grafito">Total del día</p>
            </div>

        </div>

    </div>



    <div class="space-y-4">

        <div class="flex items-center gap-3">
            <div class="h-7 w-1 rounded-full bg-hagalo"></div>

            <div>
                <h2 class="text-base font-bold text-gris-grafito">Ventas y facturación</h2>
                <p class="text-xs text-gray-500">Seguimiento de ventas y últimas facturas</p>
            </div>
        </div>

        <div class="grid grid-cols-1 items-stretch gap-5 md:grid-cols-2 xl:grid-cols-3">

           
            @php
                $maxVenta = collect($ventasCategoria)->max('total_ventas') ?: 1;
            @endphp

            <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gris-calido-claro text-white">
                        <i class="fa-solid fa-chart-column text-lg"></i>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Ventas por categoría</p>
                        <p class="text-xs text-gray-500">Resumen de ventas</p>
                    </div>
                </div>

                <div class="mt-4 max-h-64 min-h-24 space-y-3 overflow-y-auto rounded-xl bg-white/60 px-3 py-3">

                    @forelse ($ventasCategoria as $v)

                        <div>
                            <div class="mb-1 flex items-center justify-between gap-3 text-xs">
                                <span class="truncate text-gris-grafito">{{ $v->nombre }}</span>
                                <span class="shrink-0 font-semibold text-gris-grafito">${{ number_format($v->total_ventas, 2) }}</span>
                            </div>

                            <div class="h-2 w-full overflow-hidden rounded-full bg-this">
                                <div class="h-2 rounded-full bg-verde-salvia transition-all duration-300"
                                     style="width: {{ ($v->total_ventas / $maxVenta) * 100 }}%"></div>
                            </div>
                        </div>

                    @empty

                        <p class="py-3 text-center text-xs text-gray-500">No hay ventas registradas.</p>

                    @endforelse

                </div>

            </div>


           
            <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gris-calido-claro text-white">
                        <i class="fa-solid fa-calendar-week text-lg"></i>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Ventas por día</p>
                        <p class="text-xs text-gray-500">Últimos 7 días con ventas</p>
                    </div>
                </div>

                <div class="mt-4 max-h-64 min-h-24 divide-y divide-gray-100 overflow-y-auto rounded-xl bg-white/60 px-3 py-1">

                    @forelse ($ventasPorDia as $d)

                        <div class="flex items-center justify-between py-2.5 text-xs">
                            <span class="text-gray-500">
                                {{ \Carbon\Carbon::parse($d->fecha)->format('d/m/Y') }}
                            </span>
                            <span class="font-semibold text-ciruela">
                                ${{ number_format($d->total_dia ?? 0, 2) }}
                            </span>
                        </div>

                    @empty

                        <p class="py-6 text-center text-xs text-gray-500">No hay ventas registradas.</p>

                    @endforelse

                </div>

            </div>

           
            <div class="h-full w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm md:col-span-2 xl:col-span-1">

                <div class="flex items-center gap-3 border-b border-linea-exterior-tabla pb-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#465D4A]/10 text-[#465D4A]">
                        <i class="fa-solid fa-receipt text-lg"></i>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gris-grafito">Facturas recientes</p>
                        <p class="text-xs text-gray-500">Últimas facturas registradas</p>
                    </div>
                </div>

                <div class="mt-1 divide-y divide-gray-100">

                    @forelse ($facturasRecientes as $f)

                        <div class="flex items-center justify-between gap-3 py-3">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#465D4A]/10 text-[#465D4A]">
                                    <i class="fa-solid fa-file-lines"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-gris-grafito">{{ $f->codigo }}</p>
                                    <p class="mt-1 truncate text-xs text-gray-500">
                                        {{ $f->cliente ?? 'Sin cliente' }} · {{ ucfirst($f->estado) }}
                                    </p>
                                </div>

                            </div>

                            <span class="shrink-0 text-sm font-bold text-[#465D4A]">
                                ${{ number_format($f->total, 2) }}
                            </span>

                        </div>

                    @empty

                        <p class="py-6 text-center text-sm text-gray-500">No hay facturas registradas.</p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


   
    <div class="space-y-4">

        <div class="flex items-center gap-3">
            <div class="h-7 w-1 rounded-full bg-[#465D4A]"></div>

            <div>
                <h2 class="text-base font-bold text-gris-grafito">Control de inventario</h2>
                <p class="text-xs text-gray-500">Alertas y seguimiento de los productos</p>
            </div>
        </div>

        <div class="grid grid-cols-1 items-start gap-5 md:grid-cols-2 xl:grid-cols-3">

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