<div>
    <button type="button" wire:click="abrirModal" class="rounded-lg p-2
            text-terracota-suave transition-all duration-200
            hover:bg-terracota-suave/10 hover:text-terracota-oscuro
            cursor-pointer text-base">

        <i class="fa-solid fa-trash-can"></i>
    </button>

    @if ($modal)
    <div class="fixed inset-0 z-50 flex items-center justify-center
                    bg-gris-calido-oscuro/50 backdrop-blur-sm p-4">

        
        <div class="w-full max-w-md overflow-hidden rounded-2xl
                        bg-blanco-calido shadow-2xl border border-gris-suave/30">

            
            <div class="flex items-start justify-between border-b
                            border-gris-suave/40 px-6 py-5">

                <div>
                    <div class="flex items-center gap-2">
                        <div class="flex h-10 w-10 items-center justify-center
                                        rounded-xl bg-terracota-suave/10">

                            <x-lucide-shield-x class="h-5 w-5 text-terracota-suave" />
                        </div>

                        <div>
                            <h2 class="text-lg font-bold text-gris-grafito">
                                Anular permisos
                            </h2>

                            <p class="text-xs text-gris-calido-oscuro/70">
                                Administración de roles
                            </p>
                        </div>
                    </div>
                </div>

                <button type="button" wire:click="cerrarModal" class="rounded-lg p-2 text-gris-calido-oscuro/60
                            transition hover:bg-gris-suave/30
                            hover:text-gris-grafito cursor-pointer">

                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            {{-- Contenido --}}
            <div class="px-6 py-5">

                <p class="mb-4 text-sm leading-relaxed text-gris-calido-oscuro">
                    Selecciona los permisos que deseas retirar de este rol.
                    Los permisos que no selecciones permanecerán asignados.
                </p>

                <form action="{{ route('role.anular.permisos', $rolId) }}" method="POST">

                    @csrf
                    @method('DELETE')

                    {{-- Lista de permisos --}}
                    <div class="max-h-64 space-y-2 overflow-y-auto
                                    rounded-xl border border-gris-suave/40
                                    bg-white/50 p-3">

                        @forelse ($permisos->permissions as $permiso)

                        <label class="group flex cursor-pointer items-center gap-3
                                            rounded-lg border border-transparent
                                            px-3 py-3 transition-all duration-200
                                            hover:border-terracota-suave/30
                                            hover:bg-terracota-suave/5">

                            <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" class="h-4 w-4 rounded border-gris-suave
                                                text-terracota-suave
                                                focus:ring-terracota-suave/30
                                                cursor-pointer">

                            <div class="flex min-w-0 flex-1 items-center gap-2">

                                <x-lucide-key-round class="h-4 w-4 shrink-0
                                                    text-gris-calido-oscuro/60
                                                    group-hover:text-terracota-suave" />

                                <span class="wrap-break-words text-sm font-medium
                                                        text-gris-grafito">
                                    {{ $permiso->name }}
                                </span>
                            </div>

                        </label>

                        @empty

                        <div class="flex flex-col items-center py-8 text-center">

                            <x-lucide-shield-check class="mb-3 h-10 w-10 text-verde-suave" />

                            <p class="text-sm font-semibold text-gris-grafito">
                                No hay permisos asignados
                            </p>

                            <p class="mt-1 text-xs text-gris-calido-oscuro">
                                Este rol no tiene permisos para anular.
                            </p>

                        </div>

                        @endforelse

                    </div>

                    @error('permisos')
                    <p class="mt-2 text-xs font-medium text-terracota-oscuro">
                        {{ $message }}
                    </p>
                    @enderror

                    @error('permisos.*')
                    <p class="mt-2 text-xs font-medium text-terracota-oscuro">
                        {{ $message }}
                    </p>
                    @enderror

                    <div class="mt-6 flex items-center justify-end gap-3">

                        <button type="button" wire:click="cerrarModal" class="rounded-lg border border-gris-suave/60
                                    px-4 py-2.5 text-sm font-semibold
                                    text-gris-calido-oscuro transition
                                    hover:bg-gris-suave/20 cursor-pointer">
                            Cancelar
                        </button>

                        <button type="submit" @disabled($permisos->permissions->isEmpty())
                            class="flex items-center gap-2 rounded-lg
                            bg-terracota-suave px-4 py-2.5
                            text-sm font-semibold text-white
                            shadow-sm transition
                            hover:bg-terracota-oscuro
                            disabled:cursor-not-allowed
                            disabled:opacity-50 cursor-pointer">

                            <x-lucide-trash-2 class="h-4 w-4" />

                            Anular permisos
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
    @endif
</div>