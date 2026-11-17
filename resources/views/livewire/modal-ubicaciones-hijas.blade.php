<div>
    {{-- Botón para abrir el modal --}}
    <button type="button" wire:click="abrirModal" class="inline-flex items-center gap-2 rounded-lg bg-ambar-claro
        px-4 py-2.5 text-sm font-semibold text-blanco-calido shadow-sm
        transition-all duration-200 hover:bg-ambar-oscuro hover:shadow-md
        active:scale-95 cursor-pointer">

        <x-lucide-folder-tree class="h-4 w-4" />
        <span>Ver ubicaciones hijas</span>

        @if ($ubicacion->hijo->count() > 0)
        <span class="rounded-full bg-blanco-calido/20 px-2 py-0.5 text-xs">
            {{ $ubicacion->hijo->count() }}
        </span>
        @endif
    </button>

    @if ($modalAbierto)
    {{-- Fondo del modal --}}
    <div class="fixed inset-0 z-50 flex items-center justify-center
            bg-gris-calido-oscuro/50 p-4 backdrop-blur-sm
            transition-all duration-300">

        {{-- Contenedor --}}
        <div class="w-full max-w-lg overflow-hidden rounded-2xl
                border border-linea-exterior-tabla bg-blanco-calido
                shadow-2xl">

            {{-- Encabezado --}}
            <div class="flex items-start justify-between border-b
                    border-linea-exterior-tabla bg-lino-natural px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-ambar-claro/15 text-ambar-oscuro">
                        <x-lucide-folder-tree class="h-6 w-6" />
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-gris-calido-oscuro">
                            Ubicaciones hijas
                        </h2>

                        <p class="mt-1 text-xs text-gris-calido-claro">
                            Contenedores de {{ $ubicacion->nombre }}
                        </p>
                    </div>
                </div>

                <button type="button" wire:click="cerrarModal" class="rounded-lg p-2 text-gris-calido-claro
                        transition-colors hover:bg-terracota-oscuro/10
                        hover:text-terracota-oscuro cursor-pointer" aria-label="Cerrar modal">

                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            {{-- Contenido --}}
            <div class="p-6">

                {{-- Resumen --}}
                <div class="mb-5 flex items-center justify-between">
                    <p class="text-sm font-medium text-gris-calido-oscuro">
                        Ubicaciones registradas
                    </p>

                    <span class="rounded-full bg-ambar-claro/15
                            px-3 py-1 text-xs font-semibold text-ambar-oscuro">
                        {{ $ubicacion->hijo->count() }}
                        {{ $ubicacion->hijo->count() === 1 ? 'ubicación' : 'ubicaciones' }}
                    </span>
                </div>

                @if ($ubicacion->hijo->isNotEmpty())

                {{-- Tabla --}}
                <div class="overflow-hidden rounded-xl border
                            border-linea-exterior-tabla">

                    <div class="max-h-72 overflow-y-auto">
                        <table class="w-full border-collapse text-left">

                            <thead class="sticky top-0 z-10 bg-lino-natural
                                        text-xs font-semibold uppercase
                                        tracking-wide text-gris-marron-calido">

                                <tr class="border-b border-linea-thead">
                                    <th class="w-16 px-4 py-3 text-center">
                                        #
                                    </th>

                                    <th class="px-4 py-3">
                                        Nombre
                                    </th>

                                    <th class="w-20 px-4 py-3 text-center">
                                        Acción
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-linea-tr-tbody">

                                @foreach ($ubicacion->hijo as $index => $hija)
                                <tr wire:key="ubicacion-hija-{{ $hija->id }}" class="bg-blanco-calido transition-colors
                                                hover:bg-lino-natural/70">

                                    <td class="px-4 py-3 text-center
                                                    text-xs font-medium text-gris-calido-claro">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="block text-sm font-medium
                                                        text-gris-calido-oscuro">
                                            {{ $hija->nombre }}
                                        </span>

                                        <span class="mt-0.5 block text-xs
                                                        text-gris-calido-claro">
                                            {{ $hija->codigo }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('ubicacion.show', $hija->id) }}" title="Ver ubicación" class="inline-flex h-9 w-9 items-center
                                                        justify-center rounded-lg text-ambar-oscuro
                                                        transition-all hover:bg-ambar-claro/15
                                                        hover:text-ambar-claro">

                                            <x-lucide-eye class="h-4 w-4" />
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                @else

                {{-- Estado vacío --}}
                <div class="flex flex-col items-center justify-center
                            rounded-xl border border-dashed border-linea-exterior-tabla
                            bg-lino-natural/40 px-5 py-10 text-center">

                    <div class="mb-3 flex h-14 w-14 items-center
                                justify-center rounded-full bg-ambar-claro/10
                                text-ambar-oscuro">

                        <x-lucide-folder-open class="h-7 w-7" />
                    </div>

                    <h3 class="text-sm font-semibold text-gris-calido-oscuro">
                        Sin ubicaciones hijas
                    </h3>

                    <p class="mt-1 max-w-xs text-xs leading-relaxed
                                text-gris-calido-claro">
                        Esta ubicación todavía no tiene otras ubicaciones
                        registradas dentro de ella.
                    </p>
                </div>

                @endif
            </div>

            {{-- Pie del modal --}}
            <div class="flex justify-end border-t border-linea-exterior-tabla
                    bg-lino-natural/50 px-6 py-4">

                <button type="button" wire:click="cerrarModal" class="rounded-lg border border-linea-exterior-tabla
                        bg-blanco-calido px-5 py-2 text-sm font-medium
                        text-gris-calido-oscuro transition-colors
                        hover:bg-lino-natural cursor-pointer">
                    Cerrar
                </button>
            </div>

        </div>
    </div>
    @endif
</div>