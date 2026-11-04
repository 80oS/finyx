<div>
    <button type="button" wire:click='abrirModal' 
        class="bg-azul-grisaceo hover:bg-azul-grisaceo-oscuro rounded p-2 
        capitalize text-blanco-calido cursor-pointer">
        mover productos
    </button>

    @if ($mostrarModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">

            <div class="w-full max-w-4xl rounded-xl bg-white shadow-xl">

                {{-- Cabecera --}}
                <div class="flex justify-between border-b border-gris-suave p-5">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            Mover productos
                        </h2>

                        <p class="text-sm text-gray-500">
                            Selecciona los productos y las cantidades.
                        </p>
                    </div>

                    <button
                        type="button"
                        wire:click="cerrarModal"
                        class="text-xl text-gris-calido-claro hover:text-gris-suave cursor-pointer"
                    >
                        &times;
                    </button>
                </div>

                <div class="p-5">
                    <form method="POST" action="{{ route('ubicacion.moverProductos', $ubicacionId) }}">
                        @csrf

                        {{-- Seleccionar ubicación destino --}}
                        <select name="id_destino" required class="w-full px-3.5 py-2.5 bg-blanco-calido border 
                        border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none 
                        focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                            <option value="">Selecciona una ubicación</option>

                            @foreach ($ubicacionesDestino as $destino)
                                <option value="{{ $destino->id }}">
                                    {{ $destino->nombre }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Seleccionar productos --}}
                        @foreach ($asignaciones as $asignacion)
                            <div>
                                <input
                                    type="hidden"
                                    name="productos[{{ $asignacion->id_producto }}][id_producto]"
                                    value="{{ $asignacion->id_producto }}">

                                <input
                                    type="hidden"
                                    name="productos[{{ $asignacion->id_producto }}][seleccionado]"
                                    value="0">

                                <div class="flex items-center border border-gris-calido-claro p-2 my-3 rounded-lg gap-5">
                                    <input
                                    type="checkbox"
                                    name="productos[{{ $asignacion->id_producto }}][seleccionado]"
                                    value="1"
                                    class="h-5 w-5 accent-verde-salvia-claro border-verde-salvia-claro rounded">

                                    <label>
                                        {{ $asignacion->producto->nombre }}
                                        (Disponible: {{ $asignacion->cantidad }})
                                    </label>

                                    <input
                                        type="number"
                                        name="productos[{{ $asignacion->id_producto }}][cantidad]"
                                        min="1"
                                        max="{{ $asignacion->cantidad }}"
                                        value="{{ $asignacion->cantidad }}"
                                        class="w-16 px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                </div>
                            </div>
                        @endforeach
                        <div class="flex items-center justify-end pt-4 border-t border-gris-suave/50">
                            <button type="submit" class="rounded-sm bg-verde-salvia px-3 py-2
                                        text-blanco-calido hover:bg-verde-salvia-claro
                                        disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer">
                                Mover productos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
