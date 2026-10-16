<div class="grid grid-cols-2 gap-5">
    <div class="relative">
        <label class="block text-sm font-medium text-gris-calido-oscuro mb-1.5 capitalize">
            cliente / cedula</label>
        <input
        wire:model.live.debounce.300ms="identificacion"
        wire:keyup="buscarCliente" 
        class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm 
        text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
        focus:border-linea-foco transition-all">
        </input>

        @if (count($sugerencias) > 0)
            <div class="absolute z-50 mt-1 w-full overflow-hidden rounded-lg border border-gris-calido-claro 
                        bg-white shadow-lg">
                @foreach ($sugerencias as $cliente)
                    <button type="button"
                        wire:click='seleccionarCliente({{ $cliente['id'] }})'
                        class="w-full border-b px-2 py-2 text-left hover:bg-lino-natural">                    
                    <div class="flex flex-row items-center justify-between">
                        <div class="font-medium">
                            {{ $cliente['nombre'] }}
                        </div>
                        <div class="text-gris-calido-claro">
                            cedula: {{ $cliente['cedula'] }}
                        </div>
                    </div>
                    </button>
                @endforeach
            </div>    
        @endif
    </div>

    <div class="">
        <label class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nombre del Cliente</label>
        <input
            type="text"
            value="{{ $nombre }}"
            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm 
            text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
            focus:border-linea-foco transition-all"
            readonly
        >

        <input
            type="hidden"
            name="id_cliente"
            value="{{ $clienteSeleccionado }}"
        >
    </div>

    @error('identificacion')
        <p>{{ $message }}</p>
    @enderror

    
</div>
