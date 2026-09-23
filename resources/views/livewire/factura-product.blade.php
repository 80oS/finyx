<div>
    
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
                    text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-3 py-3 font-medium">index</th>
                    <th class="px-3 py-3 font-medium">Codigo</th>
                    <th class="px-3 py-3 font-medium">Producto</th>
                    <th class="px-3 py-3 font-medium">precio unitario</th>
                    <th class="px-3 py-3 font-medium">cantidad</th>
                    <th class="px-3 py-3 font-medium">subtotal</th>
                    <th class="px-3 py-3 font-medium">agregar</th>
                </tr>
            </thead>

            <tbody id="productos-container">
                @foreach ($productos as $index => $producto)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                        border-linea-tr-tbody text-center text-xs" wire:key="producto-{{ $index }}">
                        <td class="p-3">
                            {{ $index + 1 }}
                        </td>
                        {{-- codigo --}}
                        <td class="p-3">
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                            text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                            focus:border-linea-foco transition-all" wire:model='productos.{{ $index }}.codigo'>
                        </td>
                        {{-- nombre --}}
                        <td class="p-3">
                            <input type="text"  class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                        text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                        focus:border-linea-foco transition-all" wire:model='productos.{{ $index }}.nombre'>
                        </td>
                        {{-- precio unitario --}}
                        <td class="p-3">
                            <input type="number" step="0.1" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                            text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                            focus:border-linea-foco transition-all" wire:model='productos.{{ $index }}.precio_unitario'>
                        </td>
                        {{-- cantidad --}}
                        <td class="p-3">
                            <input type="number" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                            text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                            focus:border-linea-foco transition-all" wire:model='productos.{{ $index }}.cantidad'>
                        </td>
                        {{-- subtotal --}}
                        <td class="p-3">
                            <input type="number" step="0.1" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                            text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                            focus:border-linea-foco transition-all" wire:model='productos.{{ $index }}.subtotal'>
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
    
    
    <button wire:click="agregarProducto" type="button" class="text-lg text-verde-salvia
    hover:text-verde-salvia-claro cursor-pointer m-0 p-0">
        <i class="fa-solid fa-clone"></i>
    </button>
</div>
