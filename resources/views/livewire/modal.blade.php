<div>
    <input type="hidden" name="observaciones" value="{{ $observaciones }}">

    {{-- Botón abrir modal --}}
    <div class="mb-5">
        <button type="button" wire:click="abrirModal" class="inline-flex items-center gap-2 rounded-lg bg-verde-salvia
            px-4 py-2.5 text-sm font-semibold text-blanco-calido shadow-sm
            transition-all duration-200 hover:bg-verde-salvia-claro
            hover:shadow-md active:scale-95 cursor-pointer">

            <x-lucide-message-square-text class="h-4 w-4" />
            Observaciones
        </button>
    </div>

    @if ($modalActivo)
    {{-- Fondo del modal --}}
    <div class="fixed inset-0 z-50 flex items-center justify-center
            bg-gris-calido-oscuro/55 p-4 backdrop-blur-sm transition-all">

        {{-- Contenedor --}}
        <div class="w-full max-w-md overflow-hidden rounded-2xl
                border border-linea-exterior-tabla bg-blanco-calido shadow-2xl">

            {{-- Cabecera --}}
            <div class="flex items-center justify-between border-b
                    border-linea-exterior-tabla bg-lino-natural px-6 py-5">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center
                            rounded-xl bg-verde-salvia/15 text-verde-salvia">
                        <x-lucide-notebook-pen class="h-5 w-5" />
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-gris-calido-oscuro">
                            Observaciones
                        </h2>

                        <p class="mt-0.5 text-xs text-gris-calido-claro">
                            Agrega información adicional a la factura.
                        </p>
                    </div>
                </div>

                <button type="button" wire:click="cerrarModal" aria-label="Cerrar modal" class="rounded-lg p-2 text-gris-calido-claro
                        transition-colors hover:bg-terracota-oscuro/10
                        hover:text-terracota-oscuro cursor-pointer">

                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            {{-- Contenido --}}
            <div class="p-6">

                <div class="mb-6">
                    <label for="observaciones" class="mb-2 block text-sm font-semibold
                            text-gris-calido-oscuro">
                        Descripción de la observación
                    </label>

                    <input id="observaciones" type="text" wire:model="observaciones"
                        placeholder="Escribe una observación..." class="w-full rounded-lg border border-linea-input
                            bg-blanco-calido px-3.5 py-3 text-sm
                            text-gris-calido-oscuro placeholder:text-gris-calido-claro
                            transition-all focus:border-linea-foco
                            focus:outline-none focus:ring-2 focus:ring-linea-foco/30" />

                    <p class="mt-2 flex items-center gap-1.5 text-xs
                            text-gris-calido-claro">
                        <x-lucide-info class="h-3.5 w-3.5 shrink-0" />
                        Esta información quedará asociada a la factura.
                    </p>
                </div>

                {{-- Acciones --}}
                <div class="flex justify-end gap-3 border-t
                        border-linea-exterior-tabla pt-5">

                    <button type="button" wire:click="cerrarModal" class="rounded-lg border border-linea-exterior-tabla
                            bg-blanco-calido px-4 py-2.5 text-sm font-medium
                            text-gris-calido-oscuro transition-colors
                            hover:bg-lino-natural cursor-pointer">
                        Cancelar
                    </button>

                    <button type="button" wire:click="agregarObservacion" class="inline-flex items-center gap-2 rounded-lg
                            bg-verde-salvia px-5 py-2.5 text-sm font-semibold
                            text-blanco-calido shadow-sm transition-all
                            hover:bg-verde-salvia-claro hover:shadow-md
                            active:scale-95 cursor-pointer">

                        <x-lucide-check class="h-4 w-4" />
                        Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>