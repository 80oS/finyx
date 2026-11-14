<div class="mx-auto max-w-6xl px-4 py-6">
    <a href="{{ route('compra.index') }}"
       class="inline-block rounded-lg bg-verde-salvia px-4 py-2.5 text-sm text-blanco-calido transition-all hover:bg-verde-salvia-claro">
        Volver a compras
    </a>

    <div class="mt-6 flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gris-calido-oscuro">Nueva orden de compra</h1>
            <p class="text-sm text-gris-calido-oscuro">Registra los productos que vas a pedir a tu proveedor.</p>
        </div>
    </div>

    @if ($errors->any())
        <div wire:key="errores-{{ $intentos }}"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition.opacity.duration.500ms
             class="mt-4 rounded border border-border-alert-error bg-alert-error px-4 py-3 text-text-alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_320px]">

        {{-- Productos --}}
        <div class="rounded-2xl border border-linea-input bg-blanco-calido">
            <div class="flex items-center justify-between p-5">
                <div>
                    <h2 class="font-semibold text-gris-calido-oscuro">Productos</h2>
                    <p class="text-xs text-gris-calido-oscuro">Añade los artículos para esta orden</p>
                </div>
                <button type="button" wire:click="agregarLinea"
                        class="cursor-pointer rounded-lg border border-linea-input px-3 py-2 text-sm font-medium text-verde-salvia">
                    + Añadir producto
                </button>
            </div>

            {{-- Encabezado --}}
            <div class="grid grid-cols-[minmax(0,1fr)_80px_110px_80px_130px_24px] gap-3 border-y border-linea-input px-5 py-2 text-[11px] font-semibold tracking-wider text-gris-calido-oscuro">
                <span>PRODUCTO</span>
                <span>CANTIDAD</span>
                <span>PRECIO UNIT.</span>
                <span>IVA %</span>
                <span class="text-center">TOTAL</span>
                <span></span>
            </div>

            {{-- Filas --}}
            @foreach ($lineas as $i => $l)
                <div wire:key="linea-{{ $i }}"
                     class="grid grid-cols-[minmax(0,1fr)_80px_110px_80px_130px_24px] items-center gap-3 border-b border-linea-input px-5 py-3">

                    <input type="text" wire:model="lineas.{{ $i }}.nombre" placeholder="Nombre del producto"
                           class="w-full rounded-lg border border-linea-input bg-blanco-calido px-3 py-2 text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco">

                    <input type="number" min="1" wire:model.live="lineas.{{ $i }}.cantidad"
                           class="w-full rounded-lg border border-linea-input bg-blanco-calido px-2 py-2 text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco">

                    <input type="number" min="0" step="0.01" wire:model.live="lineas.{{ $i }}.precio"
                           class="w-full rounded-lg border border-linea-input bg-blanco-calido px-2 py-2 text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco">

                    <input type="number" min="0" max="100" step="0.01" wire:model.live="lineas.{{ $i }}.iva"
                           placeholder="0"
                           class="w-full rounded-lg border border-linea-input bg-blanco-calido px-2 py-2 text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco">

                    <span class="whitespace-nowrap text-center text-sm font-semibold text-gris-calido-oscuro">
                        {{ number_format($this->filas[$i]['total'], 2, ',', '.') }}
                    </span>

                    <button type="button" wire:click="quitarLinea({{ $i }})"
                            title="Eliminar"
                            class="cursor-pointer text-gray-400 hover:text-red-500">
                        <i class="fi fi-rr-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>

        {{-- Resumen --}}
        <div class="h-fit rounded-2xl border border-linea-input bg-blanco-calido p-5">
            <h2 class="font-semibold text-gris-calido-oscuro">Resumen</h2>

            <label class="mt-4 block text-[11px] font-semibold tracking-wider text-gris-calido-oscuro">PROVEEDOR</label>
            <select wire:model="id_proveedor"
                    class="mt-1 w-full rounded-lg border border-linea-input bg-blanco-calido px-3 py-2 text-sm text-gris-calido-oscuro">
                <option value="">Seleccione un proveedor</option>
                @foreach ($proveedores as $p)
                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                @endforeach
            </select>

            <label class="mt-4 block text-[11px] font-semibold tracking-wider text-gris-calido-oscuro">MÉTODO DE PAGO</label>
            <select wire:model="metodo_pago"
                    class="mt-1 w-full rounded-lg border border-linea-input bg-blanco-calido px-3 py-2 text-sm text-gris-calido-oscuro">
                <option value="">Seleccione un método de pago</option>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="transferencia">Transferencia</option>
            </select>

            <dl class="mt-5 space-y-3 border-t border-linea-input pt-4 text-sm text-gris-calido-oscuro">
                <div class="flex justify-between">
                    <dt>Productos ({{ count($lineas) }})</dt>
                    <dd>{{ number_format($this->totales['subtotal'], 2, ',', '.') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt>IVA</dt>
                    <dd>{{ number_format($this->totales['iva'], 2, ',', '.') }}</dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt>Descuento</dt>
                    <dd>
                        <input type="number" min="0" step="0.01" wire:model.live="descuento"
                               class="w-24 rounded-lg border border-linea-input bg-blanco-calido px-2 py-1 text-right text-sm">
                    </dd>
                </div>
            </dl>

            <div class="mt-5 flex items-end justify-between border-t border-dashed border-linea-input pt-4">
                <span class="text-sm font-semibold text-gris-calido-oscuro">Total de la compra</span>
                <span class="text-2xl font-bold text-gris-calido-oscuro">{{ number_format($this->totales['total'], 2, ',', '.') }}</span>
            </div>

            <button type="button" wire:click="guardar"
                    class="mt-5 w-full cursor-pointer rounded-lg bg-verde-salvia py-3 text-sm font-semibold text-blanco-calido hover:bg-verde-salvia-claro">
                Guardar compra
            </button>

            <a href="{{ route('compra.index') }}"
               class="mt-3 block w-full rounded-lg bg-gris-calido-claro py-3 text-center text-sm font-semibold text-blanco-calido transition-all hover:bg-gris-calido-oscuro">
                Cancelar
            </a>
        </div>
    </div>
</div>