<div>
    <div class="mb-5">
        <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Codigo de  Barras</label>
        <input type="text" id="barcode" autofocus class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                focus:border-linea-foco transition-all"
                wire:model.live="barcode"
                wire:keydown.enter.prevent="buscarProducto">
        
        @error("barcode")
            <small class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                {{ $message }}
            </small>
        @enderror
    </div>
    
    <table class="w-full text-left border-collapse">
        <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
                text-center sticky">
            <tr>        
                <th class="p-2 font-medium capitalize">indice</th>
                <th class="p-2 font-medium capitalize">Codigo</th>
                <th class="p-2 font-medium capitalize">Producto</th>
                <th class="p-2 font-medium capitalize">precio unitario</th>
                <th class="p-2 font-medium capitalize">cantidad</th>
                <th class="p-2 font-medium capitalize">subtotal</th>
                <th class="p-2 font-medium capitalize">eliminar</th>
            </tr>
        </thead>

        <tbody id="productos-container">
            @foreach ($productos as $index => $producto)                
                <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all text-center text-xs" wire:key="producto-{{ $index }}">
                    <td class="p-1">
                        {{ $index + 1 }}
                    </td>
                    {{-- codigo --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][codigo]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" 
                        wire:model='productos.{{ $index }}.codigo'
                        readonly>

                        <input type="hidden" name="productos[{{ $index }}][id_producto]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" 
                        wire:model='productos.{{ $index }}.id_producto'
                        value="{{ $producto['id_producto'] }}" readonly>
                    </td>
                    {{-- nombre --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][nombre]"  class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                    text-sm text-gris-calido-oscuro" 
                    wire:model='productos.{{ $index }}.nombre'
                    value="{{ $producto['nombre'] }}"
                    readonly>
                    </td>
                    {{-- precio unitario --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][precio_unitario]" step="0.1" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" 
                        wire:model='productos.{{ $index }}.precio_unitario' readonly>
                    </td>
                    {{-- cantidad --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][cantidad]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" 
                        wire:model.live='productos.{{ $index }}.cantidad'
                        wire:change='calcularSubtotal({{ $index }})'>
                    </td>
                    {{-- subtotal --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][subtotal]" step="0.1" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.subtotal'
                        readonly value="{{ $producto['subtotal'] }}">
                    </td>
                    {{-- agreagar --}}
                    <td>
                        <button wire:click='eliminarProducto({{ $index }})' 
                        type="button" class="text-lg text-terracota-suave
                        hover:text-terracota-oscuro cursor-pointer"
                        @if (count($productos) === 1) disabled @endif>
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end grid grid-cols-2">
        <strong>Total:</strong>

        <span id="total">
            ${{ number_format($this->total(), 2) }}
            <input type="hidden" name="total" value="{{($this->total())}}">
        </span>
    </div>
</div>
