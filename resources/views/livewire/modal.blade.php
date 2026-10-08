<div>
    <input
        type="hidden"
        name="observaciones"
        value="{{ $observaciones }}"
    >
    <div class="mb-5">
        <button type="button" wire:click='abrirModal' 
            class="bg-verde-salvia hover:bg-verde-salvia-claro rounded-sm p-2 text-blanco-calido cursor-pointer">
            observaciones
        </button>
    </div>
    @if ($modalActivo)
        <div class="fixed inset-0 flex items-center justify-center bg-gris-calido-oscuro/50 z-50 transition-all">
            <div class="bg-blanco-calido rounded-lg p-6 w-96">
                <div class="mb-5 text-end">
                    <button type="button" wire:click='cerrarModal' 
                        class="bg-terracota-suave hover:bg-terracota-oscuro rounded-sm p-1 text-blanco-calido cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <hr class="text-gris-calido-claro">

                <div class="mb-5 mt-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">observaciones</label>
                    <input type="text" name="observaciones" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                focus:border-linea-foco transition-all"
                                wire:model="observaciones">
                </div>

                <div class="mb-5">
                    <button type="button" 
                    wire:click="agregarObservacion"
                    class="bg-verde-salvia hover:bg-verde-salvia-claro rounded-sm p-2 text-blanco-calido cursor-pointer">
                        Agregar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
