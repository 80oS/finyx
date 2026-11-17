<div>
    <div class="mb-5">
        <button type="button" wire:click='abrirModal' 
            class="bg-verde-salvia hover:bg-verde-salvia-claro rounded-sm p-2 text-blanco-calido cursor-pointer">
            permisos
        </button>
    </div>
    @if ($modal)
        <div class="fixed inset-0 flex items-center justify-center bg-gris-calido-oscuro/50 z-50 transition-all">
            <div class="bg-blanco-calido rounded-lg p-6 w-96">
                <div class="mb-5 text-end">
                    <button type="button" wire:click='cerrarModal' 
                        class="bg-terracota-suave hover:bg-terracota-oscuro rounded-sm p-1 text-blanco-calido cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <hr class="text-gris-suave/50 my-3">

                <div class="max-h-64 overflow-y-auto pr-2 space-y-2">

                    <ul class="space-y-2">

                        @forelse ($permisos->permissions as $permiso)
                            <li class="flex items-center gap-3 px-3 py-2.5
                                    rounded-lg border border-gray-100
                                    bg-white hover:bg-crema-suave
                                    hover:border-gray-200 transition-colors">

                                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                                            rounded-lg bg-verde-suave/15">

                                    <x-lucide-shield-check
                                        class="h-4 w-4 text-verde-suave"
                                    />

                                </div>

                                <span class="text-sm font-medium text-gris-calido-oscuro">
                                    {{ $permiso->name }}
                                </span>

                                <span class="ml-auto text-xs text-gray-400">
                                    Asignado
                                </span>

                            </li>
                        @empty

                            <li class="flex flex-col items-center justify-center py-8
                                    text-center rounded-lg border border-dashed
                                    border-gray-300">

                                <x-lucide-shield-x class="h-8 w-8 text-gray-400 mb-2"/>

                                <p class="text-sm font-medium text-gray-500">
                                    Sin permisos asignados
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Este rol todavía no tiene permisos.
                                </p>

                            </li>

                        @endforelse

                    </ul>

                </div>
            </div>
        </div>
    @endif
</div>
