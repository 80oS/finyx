<div>
    <table class="w-full text-left border-collapse">
        <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
                text-center sticky">
            <tr>
                <th class="p-2 font-medium capitalize">indice</th>
                <th class="p-2 font-medium capitalize">id</th>
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
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][id_producto]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.id_producto'>
                    </td>
                    {{-- codigo --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][codigo]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.codigo'>
                    </td>
                    {{-- nombre --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][nombre]"  class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                    text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.nombre'>
                    </td>
                    {{-- precio unitario --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][precio_unitario]" step="0.1" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.precio_unitario'>
                    </td>
                    {{-- cantidad --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][cantidad]" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.cantidad'>
                    </td>
                    {{-- subtotal --}}
                    <td class="p-1">
                        <input type="text" name="productos[{{ $index }}][subtotal]" step="0.1" class="w-full px-3.5 py-2.5 
                        border-b border-gris-calido-oscuro
                        text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.subtotal'>
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
    
    
    <button wire:click="agregarProducto" type="button" class="text-lg bg-verde-salvia
    hover:bg-verde-salvia-claro cursor-pointer mt-2 p-2 text-blanco-calido rounded-sm">
        agregar producto <i class="fa-solid fa-clone"></i>
    </button>
</div>
