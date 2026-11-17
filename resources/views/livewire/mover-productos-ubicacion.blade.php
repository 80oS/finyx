
<div>
    {{-- Botón --}}
    <button type="button" wire:click="abrirModal"
        class="inline-flex items-center gap-2 rounded-lg bg-azul-grisaceo
        px-4 py-2.5 text-sm font-semibold text-blanco-calido shadow-sm
        transition-all duration-200 hover:bg-azul-grisaceo-oscuro
        hover:shadow-md active:scale-95 cursor-pointer">
        <x-lucide-arrow-left-right class="h-4 w-4" />
        Mover productos
    </button>

    @if ($mostrarModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center
            bg-gris-calido-oscuro/55 p-4 backdrop-blur-sm">

            <div class="w-full max-w-4xl overflow-hidden rounded-2xl
                border border-linea-exterior-tabla bg-blanco-calido shadow-2xl">

                {{-- Cabecera --}}
                <div class="flex items-start justify-between border-b
                    border-linea-exterior-tabla bg-lino-natural px-6 py-5">

                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-azul-grisaceo/15 text-azul-grisaceo">
                            <x-lucide-arrow-left-right class="h-5 w-5" />
                        </div>

                        <div>
                            <h2 class="text-base font-bold text-gris-calido-oscuro">
                                Mover productos
                            </h2>

                            <p class="mt-1 text-xs text-gris-calido-claro">
                                Selecciona los productos y las cantidades que deseas trasladar.
                            </p>
                        </div>
                    </div>

                    <button type="button" wire:click="cerrarModal"
                        class="rounded-lg p-2 text-gris-calido-claro
                        transition-colors hover:bg-terracota-oscuro/10
                        hover:text-terracota-oscuro cursor-pointer">
                        <x-lucide-x class="h-5 w-5" />
                    </button>
                </div>

                <div class="p-6">
                    <form method="POST"
                        action="{{ route('ubicacion.moverProductos', $ubicacionId) }}">
                        @csrf

                        {{-- Ubicación destino --}}
                        <div class="mb-6">
                            <label for="id_destino"
                                class="mb-2 block text-sm font-semibold text-gris-calido-oscuro">
                                Ubicación de destino
                                <span class="text-terracota-oscuro">*</span>
                            </label>

                            <div class="relative">
                                <x-lucide-map-pin class="absolute left-3.5 top-1/2
                                    h-4 w-4 -translate-y-1/2 text-gris-calido-claro" />

                                <select id="id_destino" name="id_destino" required
                                    class="w-full appearance-none rounded-lg border
                                    border-linea-input bg-blanco-calido py-3 pl-10 pr-10
                                    text-sm text-gris-calido-oscuro transition-all
                                    focus:border-linea-foco focus:outline-none
                                    focus:ring-2 focus:ring-linea-foco/30">

                                    <option value="">Selecciona una ubicación</option>

                                    @foreach ($ubicacionesDestino as $destino)
                                        <option value="{{ $destino->id }}">
                                            {{ $destino->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-lucide-chevron-down class="pointer-events-none
                                    absolute right-3.5 top-1/2 h-4 w-4
                                    -translate-y-1/2 text-gris-calido-claro" />
                            </div>
                        </div>

                        {{-- Productos --}}
                        <div class="mb-3 flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-gris-calido-oscuro">
                                Productos disponibles
                            </h3>

                            <span class="text-xs text-gris-calido-claro">
                                Marca los productos que deseas trasladar
                            </span>
                        </div>

                        <div class="max-h-80 space-y-3 overflow-y-auto
                            rounded-xl border border-linea-exterior-tabla
                            bg-lino-natural/30 p-3">

                            @foreach ($asignaciones as $asignacion)
                                <div wire:key="asignacion-{{ $asignacion->id }}"
                                    class="flex flex-col gap-3 rounded-xl border
                                    border-linea-exterior-tabla bg-blanco-calido
                                    p-4 transition-all duration-200
                                    hover:border-azul-grisaceo/40 hover:shadow-sm
                                    sm:flex-row sm:items-center">

                                    <input
                                        type="hidden"
                                        name="productos[{{ $asignacion->id_producto }}][id_producto]"
                                        value="{{ $asignacion->id_producto }}">

                                    <input
                                        type="hidden"
                                        name="productos[{{ $asignacion->id_producto }}][seleccionado]"
                                        value="0">

                                    {{-- Selección --}}
                                    <div class="flex items-center gap-3 sm:flex-1">
                                        <input
                                            type="checkbox"
                                            name="productos[{{ $asignacion->id_producto }}][seleccionado]"
                                            value="1"
                                            class="h-5 w-5 shrink-0 cursor-pointer
                                            rounded border-linea-input
                                            accent-verde-salvia-claro">

                                        <div class="flex h-10 w-10 shrink-0 items-center
                                            justify-center rounded-lg bg-azul-grisaceo/10
                                            text-azul-grisaceo">
                                            <x-lucide-package class="h-5 w-5" />
                                        </div>

                                        <div class="min-w-0">
                                            <label class="block truncate text-sm
                                                font-semibold text-gris-calido-oscuro">
                                                {{ $asignacion->producto->nombre }}
                                            </label>

                                            <p class="mt-1 text-xs text-gris-calido-claro">
                                                Disponible:
                                                <span class="font-semibold text-gris-calido-oscuro">
                                                    {{ $asignacion->cantidad }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Cantidad --}}
                                    <div class="flex items-center justify-between gap-3
                                        sm:justify-end">

                                        <label class="text-xs font-medium
                                            text-gris-calido-claro">
                                            Cantidad a mover
                                        </label>

                                        <input
                                            type="number"
                                            name="productos[{{ $asignacion->id_producto }}][cantidad]"
                                            min="1"
                                            max="{{ $asignacion->cantidad }}"
                                            value="{{ $asignacion->cantidad }}"
                                            class="w-24 rounded-lg border border-linea-input
                                            bg-blanco-calido px-3 py-2.5 text-center
                                            text-sm font-semibold text-gris-calido-oscuro
                                            transition-all focus:border-linea-foco
                                            focus:outline-none focus:ring-2
                                            focus:ring-linea-foco/30">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pie --}}
                        <div class="mt-6 flex flex-col-reverse items-center
                            justify-end gap-3 border-t border-linea-exterior-tabla
                            pt-5 sm:flex-row">

                            <button type="button"
                                wire:click="cerrarModal"
                                class="w-full rounded-lg border border-linea-exterior-tabla
                                bg-blanco-calido px-5 py-2.5 text-sm font-medium
                                text-gris-calido-oscuro transition-colors
                                hover:bg-lino-natural sm:w-auto cursor-pointer">
                                Cancelar
                            </button>

                            <button type="submit"
                                class="inline-flex w-full items-center justify-center
                                gap-2 rounded-lg bg-verde-salvia px-5 py-2.5
                                text-sm font-semibold text-blanco-calido shadow-sm
                                transition-all hover:bg-verde-salvia-claro
                                hover:shadow-md active:scale-95
                                sm:w-auto cursor-pointer">

                                <x-lucide-arrow-right-left class="h-4 w-4" />
                                Mover productos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
