<div>
    <div class="mb-5">
        <button type="button" wire:click="abrirModal" class="inline-flex items-center gap-2 rounded-lg bg-verde-salvia px-4 py-2.5
                text-sm font-semibold text-blanco-calido shadow-sm
                hover:bg-verde-salvia-claro hover:shadow-md
                active:scale-[0.98] transition-all cursor-pointer">
            <x-lucide-shield-check class="h-4 w-4" />
            Ver permisos
        </button>
    </div>

    @if ($modal)
    <div class="fixed inset-0 z-50 flex items-center justify-center
                    bg-gris-calido-oscuro/60 px-4 py-6 backdrop-blur-sm
                    transition-all">

        <div class="w-full max-w-md overflow-hidden rounded-2xl
                        border border-linea-exterior-tabla bg-blanco-calido
                        shadow-2xl">

            {{-- Encabezado --}}
            <div class="flex items-center justify-between border-b
                            border-linea-exterior-tabla bg-lino-natural
                            px-6 py-5">

                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl bg-verde-salvia/15">
                        <x-lucide-shield-check class="h-5 w-5 text-verde-salvia" />
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-gris-calido-oscuro">
                            Permisos del rol
                        </h3>

                        <p class="mt-0.5 text-xs text-gris-calido-oscuro/60">
                            Permisos actualmente asignados
                        </p>
                    </div>
                </div>

                <button type="button" wire:click="cerrarModal" class="flex h-8 w-8 items-center justify-center
                            rounded-lg text-gris-calido-oscuro/60
                            hover:bg-terracota-suave/15 hover:text-terracota-oscuro
                            transition-colors cursor-pointer" aria-label="Cerrar modal">
                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            {{-- Contenido --}}
            <div class="p-6">

                <div class="mb-4 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gris-calido-oscuro">
                        Lista de permisos
                    </span>

                    <span class="rounded-full bg-verde-salvia/10 px-3 py-1
                                    text-xs font-semibold text-verde-salvia">
                        {{ $permisos->permissions->count() }}
                        asignados
                    </span>
                </div>

                <div class="max-h-72 overflow-y-auto space-y-2 pr-1">

                    <ul class="space-y-2">

                        @forelse ($permisos->permissions as $permiso)
                        <li class="group flex items-center gap-3 rounded-xl
                                        border border-linea-input bg-white
                                        px-3.5 py-3 transition-all
                                        hover:border-verde-salvia/40
                                        hover:bg-verde-salvia/5">

                            <div class="flex h-9 w-9 shrink-0 items-center
                                                justify-center rounded-lg
                                                bg-verde-salvia/10
                                                group-hover:bg-verde-salvia/15
                                                transition-colors">

                                <x-lucide-shield-check class="h-4 w-4 text-verde-salvia" />
                            </div>

                            <span class="min-w-0 flex-1 wrap-break-word
                                                text-sm font-medium
                                                text-gris-calido-oscuro">
                                {{ $permiso->name }}
                            </span>

                            <span class="shrink-0 rounded-full
                                                bg-verde-salvia/10 px-2.5 py-1
                                                text-[10px] font-semibold
                                                text-verde-salvia">
                                Asignado
                            </span>

                        </li>
                        @empty

                        <li class="flex flex-col items-center justify-center
                                           rounded-xl border border-dashed
                                           border-linea-input bg-lino-natural/40
                                           px-5 py-10 text-center">

                            <div class="mb-3 flex h-14 w-14 items-center
                                                justify-center rounded-2xl
                                                bg-gris-suave/30">
                                <x-lucide-shield-x class="h-7 w-7 text-gris-calido-oscuro/50" />
                            </div>

                            <p class="text-sm font-semibold
                                              text-gris-calido-oscuro">
                                Sin permisos asignados
                            </p>

                            <p class="mt-1 max-w-xs text-xs leading-relaxed
                                              text-gris-calido-oscuro/60">
                                Este rol todavía no tiene permisos configurados.
                            </p>

                        </li>

                        @endforelse

                    </ul>
                </div>
            </div>

            {{-- Pie --}}
            <div class="border-t border-linea-exterior-tabla
                            bg-lino-natural/50 px-6 py-4">

                <button type="button" wire:click="cerrarModal" class="w-full rounded-lg bg-gris-calido-oscuro px-4 py-2.5
                               text-sm font-semibold text-blanco-calido
                               hover:bg-gris-calido-oscuro/85
                               active:scale-[0.99] transition-all cursor-pointer">
                    Cerrar
                </button>

            </div>

        </div>
    </div>
    @endif
</div>