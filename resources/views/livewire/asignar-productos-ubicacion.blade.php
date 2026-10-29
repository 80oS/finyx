<div>
    <div class="mb-5">
        <button type="button" wire:click='abrirModal' 
        class="bg-verde-salvia rounded-sm p-2 text-blanco-calido hover:bg-verde-salvia-claro cursor-pointer">
            <div class="flex">
                <i><x-lucide-plus class="w-6 h-6 text-blanco-calido"/></i> Asignar Productos
            </div>
        </button>
    </div>
    @if ($modalAbierto)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center
                    overflow-y-auto bg-gris-calido-oscuro/50 p-4"
        >
            <div
                class="my-auto max-h-[90vh] w-full max-w-2xl overflow-y-auto
                        rounded-lg bg-blanco-calido p-6 shadow-xl"
                role="dialog"
                aria-modal="true"
                aria-labelledby="titulo-asignar"
            >
                <div class="mb-5 flex items-center justify-between">
                    <h2
                        id="titulo-asignar"
                        class="text-lg font-semibold text-gris-calido-oscuro"
                    >
                        Asignar productos a la ubicación
                    </h2>

                    <button
                        type="button"
                        wire:click="cerrarModal"
                        aria-label="Cerrar modal"
                        class="cursor-pointer"
                    >
                        <x-lucide-x class="h-5 w-5 text-gris-calido-claro hover:text-terracota-oscuro" />
                    </button>
                </div>

                {{-- Buscar productos --}}
                <div class="mb-5">
                    <label
                        for="buscar-producto"
                        class="mb-2 block text-sm font-medium"
                    >
                        Buscar producto
                    </label>

                    <input
                        id="buscar-producto"
                        type="search"
                        wire:model.live.debounce.300ms="buscar"
                        placeholder="Nombre, código o código de barras..."
                        class="w-full rounded-sm border border-gris-suave
                                bg-white p-2 outline-none
                                focus:border-verde-salvia"
                    />
                </div>

                {{-- Resultados de búsqueda --}}
                <div class="mb-6">
                    <h3 class="mb-3 font-medium">
                        Resultados
                    </h3>

                    <div class="max-h-48 space-y-2 overflow-y-auto">
                        @forelse ($productos as $producto)
                            <div
                                wire:key="resultado-{{ $producto->id }}"
                                class="flex items-center justify-between gap-3
                                        rounded-sm border border-gris-suave/50 p-3"
                            >
                                <div>
                                    <p class="font-medium">
                                        {{ $producto->nombre }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $producto->codigo }}
                                    </p>
                                </div>

                                @if (array_key_exists(
                                    $producto->id,
                                    $productosSeleccionados
                                ))
                                    <span class="text-sm text-green-700">
                                        Añadido
                                    </span>
                                @else
                                    <button
                                        type="button"
                                        wire:click="agregarProducto({{ $producto->id }})"
                                        class="rounded-sm p-2 hover:bg-verde-salvia/20"
                                        aria-label="Añadir {{ $producto->nombre }}"
                                    >
                                        <x-lucide-plus
                                            class="h-5 w-5 text-gris-calido-oscuro"
                                        />
                                    </button>
                                @endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">
                                Escribe para buscar productos.
                            </p>
                        @endforelse
                    </div>
                </div>

                {{-- Formulario que se envía a la ruta --}}
                <form
                    action="{{ route('ubicacion.asignarProducto', $ubicacionId) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <h3 class="mb-3 font-medium">
                        Productos seleccionados
                    </h3>

                    @error('productos')
                        <p class="mb-3 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    <div class="space-y-3">
                        @forelse ($seleccionados as $producto)
                            <div
                                wire:key="seleccionado-{{ $producto->id }}"
                                class="grid grid-cols-[1fr_auto] items-center gap-3
                                    rounded-sm border border-gris-suave/50 p-3
                                    sm:grid-cols-[1fr_auto_auto]"
                            >
                                <div>
                                    <p class="font-medium">
                                        {{ $producto->nombre }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $producto->codigo }}
                                    </p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <button
                                        type="button"
                                        wire:click="disminuir({{ $producto->id }})"
                                        class="rounded-sm border border-gris-suave p-1"
                                        aria-label="Disminuir cantidad"
                                    >
                                        <x-lucide-minus class="h-4 w-4" />
                                    </button>

                                    <input
                                        type="number"
                                        min="1"
                                        step="1"
                                        name="productos[{{ $producto->id }}][cantidad]"
                                        wire:model.live="productosSeleccionados.{{ $producto->id }}"
                                        class="w-16 rounded-sm border border-gris-suave
                                            bg-white p-1 text-center"
                                        aria-label="Cantidad de {{ $producto->nombre }}"
                                    />

                                    <button
                                        type="button"
                                        wire:click="aumentar({{ $producto->id }})"
                                        class="rounded-sm border border-gris-suave p-1"
                                        aria-label="Aumentar cantidad"
                                    >
                                        <x-lucide-plus class="h-4 w-4" />
                                    </button>
                                </div>

                                {{-- ID del producto enviado a Laravel --}}
                                <input
                                    type="hidden"
                                    name="productos[{{ $producto->id }}][id_producto]"
                                    value="{{ $producto->id }}"
                                />

                                <button
                                    type="button"
                                    wire:click="quitarProducto({{ $producto->id }})"
                                    class="text-sm text-red-600 hover:text-red-800"
                                >
                                    Quitar
                                </button>
                            </div>
                        @empty
                            <p class="rounded-sm border border-dashed
                                    border-gris-suave p-4 text-center
                                    text-sm text-gray-500">
                                No has seleccionado productos.
                            </p>
                        @endforelse
                    </div>

                    <div class="mt-6 flex justify-end gap-2 border-t
                                border-gris-suave/50 pt-4">
                        <button
                            type="button"
                            wire:click="cerrarModal"
                            class="rounded-sm bg-gris-calido-claro px-3 py-2
                                    text-blanco-calido">
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            @disabled(count($productosSeleccionados) === 0)
                            class="rounded-sm bg-verde-salvia px-3 py-2
                                    text-blanco-calido hover:bg-verde-salvia-claro
                                    disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Guardar asignaciones
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
