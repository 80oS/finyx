<div>
    {{-- Botón abrir modal --}}
    <div>
        <button type="button" wire:click="abrirModal" class="inline-flex items-center gap-2 rounded-lg bg-verde-salvia
            px-4 py-2.5 text-sm font-semibold text-blanco-calido shadow-sm
            transition-all duration-200 hover:bg-verde-salvia-claro
            hover:shadow-md active:scale-95 cursor-pointer">

            <x-lucide-plus class="h-5 w-5" />
            Asignar productos
        </button>
    </div>

    @if ($modalAbierto)
    <div class="fixed inset-0 z-50 flex items-center justify-center
            overflow-y-auto bg-gris-calido-oscuro/55 p-4 backdrop-blur-sm">

        <div class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto
                rounded-2xl border border-linea-exterior-tabla
                bg-blanco-calido shadow-2xl" role="dialog" aria-modal="true" aria-labelledby="titulo-asignar">

            {{-- Cabecera --}}
            <div class="sticky top-0 z-20 flex items-center justify-between
                    border-b border-linea-exterior-tabla bg-lino-natural
                    px-6 py-5">

                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-verde-salvia/15 text-verde-salvia">
                        <x-lucide-package-plus class="h-6 w-6" />
                    </div>

                    <div>
                        <h2 id="titulo-asignar" class="text-base font-bold text-gris-calido-oscuro">
                            Asignar productos
                        </h2>

                        <p class="mt-1 text-xs text-gris-calido-claro">
                            Agrega productos y define sus cantidades para esta ubicación.
                        </p>
                    </div>
                </div>

                <button type="button" wire:click="cerrarModal" aria-label="Cerrar modal" class="rounded-lg p-2 text-gris-calido-claro
                        transition-colors hover:bg-terracota-oscuro/10
                        hover:text-terracota-oscuro cursor-pointer">
                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            <div class="p-6">

                {{-- Buscar productos --}}
                <div class="mb-6">
                    <label for="buscar-producto" class="mb-2 block text-sm font-semibold text-gris-calido-oscuro">
                        Buscar producto
                    </label>

                    <div class="relative">
                        <x-lucide-search class="absolute left-3.5 top-1/2
                                h-4 w-4 -translate-y-1/2 text-gris-calido-claro" />

                        <input id="buscar-producto" type="search" wire:model.live.debounce.300ms="buscar"
                            placeholder="Nombre, código o código de barras..." class="w-full rounded-lg border border-linea-input
                                bg-blanco-calido py-3 pl-10 pr-4 text-sm
                                text-gris-calido-oscuro placeholder:text-gris-calido-claro
                                transition-all focus:border-linea-foco
                                focus:outline-none focus:ring-2 focus:ring-linea-foco/30" />
                    </div>
                </div>

                {{-- Resultados --}}
                <div class="mb-7">
                    <div class="mb-3 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gris-calido-oscuro">
                            Resultados de búsqueda
                        </h3>

                        <span class="text-xs text-gris-calido-claro">
                            Selecciona los productos que necesitas
                        </span>
                    </div>

                    <div class="max-h-52 space-y-2 overflow-y-auto
                            rounded-xl border border-linea-exterior-tabla
                            bg-lino-natural/30 p-3">

                        @forelse ($productos as $producto)
                        <div wire:key="resultado-{{ $producto->id }}" class="flex items-center justify-between gap-3
                                    rounded-lg border border-linea-exterior-tabla
                                    bg-blanco-calido p-3 transition-all
                                    hover:border-verde-salvia/40 hover:shadow-sm">

                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center
                                            justify-center rounded-lg bg-azul-grisaceo/10
                                            text-azul-grisaceo">
                                    <x-lucide-package class="h-4 w-4" />
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold
                                                text-gris-calido-oscuro">
                                        {{ $producto->nombre }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-gris-calido-claro">
                                        {{ $producto->codigo }}
                                    </p>
                                </div>
                            </div>

                            @if (array_key_exists(
                            $producto->id,
                            $productosSeleccionados
                            ))
                            <span class="inline-flex shrink-0 items-center gap-1.5
                                            rounded-full bg-verde-salvia/15 px-3 py-1.5
                                            text-xs font-semibold text-verde-salvia">
                                <x-lucide-check class="h-3.5 w-3.5" />
                                Añadido
                            </span>
                            @else
                            <button type="button" wire:click="agregarProducto({{ $producto->id }})" class="flex h-9 w-9 shrink-0 items-center
                                            justify-center rounded-lg bg-verde-salvia/10
                                            text-verde-salvia transition-all
                                            hover:bg-verde-salvia hover:text-blanco-calido
                                            cursor-pointer" aria-label="Añadir {{ $producto->nombre }}">
                                <x-lucide-plus class="h-5 w-5" />
                            </button>
                            @endif
                        </div>
                        @empty
                        <div class="flex flex-col items-center justify-center
                                    py-7 text-center">
                            <x-lucide-search-x class="mb-2 h-8 w-8
                                        text-gris-calido-claro" />

                            <p class="text-sm font-medium text-gris-calido-oscuro">
                                No se encontraron productos
                            </p>

                            <p class="mt-1 text-xs text-gris-calido-claro">
                                Escribe un nombre, código o código de barras para buscar.
                            </p>
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Formulario --}}
                <form action="{{ route('ubicacion.asignarProducto', $ubicacionId) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-gris-calido-oscuro">
                            Productos seleccionados
                        </h3>

                        <span class="rounded-full bg-azul-grisaceo/10
                                px-3 py-1 text-xs font-semibold text-azul-grisaceo">
                            {{ count($productosSeleccionados) }}
                            seleccionados
                        </span>
                    </div>

                    @error('productos')
                    <p class="mb-3 rounded-lg border border-terracota-oscuro/20
                                bg-terracota-oscuro/5 px-3 py-2 text-sm
                                text-terracota-oscuro">
                        {{ $message }}
                    </p>
                    @enderror

                    <div class="max-h-64 space-y-3 overflow-y-auto
                            rounded-xl border border-linea-exterior-tabla
                            bg-lino-natural/30 p-3">

                        @forelse ($seleccionados as $producto)
                        <div wire:key="seleccionado-{{ $producto->id }}" class="grid grid-cols-[1fr_auto] items-center gap-3
                                    rounded-lg border border-linea-exterior-tabla
                                    bg-blanco-calido p-3 shadow-sm
                                    transition-colors hover:border-verde-salvia/40
                                    sm:grid-cols-[1fr_auto_auto]">

                            <div class="flex min-w-0 items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center
                                            justify-center rounded-lg bg-verde-salvia/10
                                            text-verde-salvia">
                                    <x-lucide-package-check class="h-4 w-4" />
                                </div>

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold
                                                text-gris-calido-oscuro">
                                        {{ $producto->nombre }}
                                    </p>

                                    <p class="mt-0.5 text-xs text-gris-calido-claro">
                                        {{ $producto->codigo }}
                                    </p>
                                </div>
                            </div>

                            {{-- Cantidad --}}
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" wire:click="disminuir({{ $producto->id }})" class="flex h-8 w-8 items-center justify-center
                                            rounded-lg border border-linea-input
                                            text-gris-calido-oscuro transition-colors
                                            hover:bg-lino-natural cursor-pointer" aria-label="Disminuir cantidad">
                                    <x-lucide-minus class="h-4 w-4" />
                                </button>

                                <input type="number" min="1" step="1" name="productos[{{ $producto->id }}][cantidad]"
                                    wire:model.live="productosSeleccionados.{{ $producto->id }}" class="w-16 rounded-lg border border-linea-input
                                            bg-blanco-calido px-2 py-2 text-center
                                            text-sm font-semibold text-gris-calido-oscuro
                                            focus:border-linea-foco focus:outline-none
                                            focus:ring-2 focus:ring-linea-foco/30"
                                    aria-label="Cantidad de {{ $producto->nombre }}" />

                                <button type="button" wire:click="aumentar({{ $producto->id }})" class="flex h-8 w-8 items-center justify-center
                                            rounded-lg border border-linea-input
                                            text-gris-calido-oscuro transition-colors
                                            hover:bg-lino-natural cursor-pointer" aria-label="Aumentar cantidad">
                                    <x-lucide-plus class="h-4 w-4" />
                                </button>
                            </div>

                            {{-- ID del producto --}}
                            <input type="hidden" name="productos[{{ $producto->id }}][id_producto]"
                                value="{{ $producto->id }}" />

                            <button type="button" wire:click="quitarProducto({{ $producto->id }})" class="col-span-2 inline-flex items-center justify-center
                                        gap-1 rounded-lg px-2 py-1.5 text-xs font-medium
                                        text-terracota-oscuro transition-colors
                                        hover:bg-terracota-oscuro/10
                                        sm:col-span-1 cursor-pointer">
                                <x-lucide-trash-2 class="h-3.5 w-3.5" />
                                Quitar
                            </button>
                        </div>
                        @empty
                        <div class="flex flex-col items-center justify-center
                                    py-8 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center
                                        justify-center rounded-full bg-azul-grisaceo/10
                                        text-azul-grisaceo">
                                <x-lucide-shopping-basket class="h-6 w-6" />
                            </div>

                            <p class="text-sm font-semibold text-gris-calido-oscuro">
                                No has seleccionado productos
                            </p>

                            <p class="mt-1 text-xs text-gris-calido-claro">
                                Busca y añade productos para asignarlos a esta ubicación.
                            </p>
                        </div>
                        @endforelse
                    </div>

                    {{-- Pie --}}
                    <div class="mt-6 flex flex-col-reverse justify-end gap-3
                            border-t border-linea-exterior-tabla pt-5 sm:flex-row">

                        <button type="button" wire:click="cerrarModal" class="rounded-lg border border-linea-exterior-tabla
                                bg-blanco-calido px-5 py-2.5 text-sm font-medium
                                text-gris-calido-oscuro transition-colors
                                hover:bg-lino-natural cursor-pointer">
                            Cancelar
                        </button>

                        <button type="submit" @disabled(count($productosSeleccionados)===0) class="inline-flex items-center justify-center gap-2
                                rounded-lg bg-verde-salvia px-5 py-2.5
                                text-sm font-semibold text-blanco-calido shadow-sm
                                transition-all hover:bg-verde-salvia-claro
                                hover:shadow-md active:scale-95
                                disabled:cursor-not-allowed disabled:opacity-50">
                            <x-lucide-save class="h-4 w-4" />
                            Guardar asignaciones
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>