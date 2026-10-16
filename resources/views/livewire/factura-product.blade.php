<div>
    <div class="grid grid-cols-3 gap-3 mt-5 mb-5">
        <div class="relative">
            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                Buscar por nombre
            </label>
            <input
            type="text"
            wire:model.live.debounce.300ms="nombre"
            class="w-full px-2 py-2 bg-blanco-calido border border-linea-input rounded-lg 
                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                    focus:border-linea-foco transition-all">

            @if(count($sugerencias) > 0)
                <div class="absolute z-50 mt-1 w-full overflow-hidden rounded-lg border border-gris-calido-claro bg-white shadow-lg">
                    @foreach($sugerencias as $producto)
                        <button
                            type="button"
                            wire:click="seleccionarProducto({{ $producto['id'] }})"
                            class="w-full border-b px-2 py-2 text-left hover:bg-lino-natural"
                        >
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium">
                                        {{ $producto['nombre'] }}
                                    </div>
                                    <div class="text-sm text-gris-calido-oscuro">
                                        · Stock:
                                        {{ $producto['stock'] }}
                                    </div>
                                </div>
                                <div class="font-semibold">
                                    ${{ number_format($producto['precio_unitario'], 2, ',', '.') }}
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif

            @error('producto')
                <p class="mt-1 text-sm text-terracota-oscuro">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div>
            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                Buscar por Codigo de  Barras
            </label>
            <input type="text" id="barcode" autofocus class="w-full px-2 py-2 bg-blanco-calido border border-linea-input rounded-lg 
                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                    focus:border-linea-foco transition-all"
                    wire:model="barcode"
                    wire:keydown.enter.prevent="buscarPorBarcode">
            
            @error("barcode")
                <small class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div>

            <label class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                Cantidad
            </label>

            <div class="flex">

                <input
                    type="number"
                    min="1"
                    wire:model="cantidad"
                    class="w-full px-2 py-2 bg-blanco-calido border border-linea-input rounded-l-lg 
                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                    focus:border-linea-foco transition-all"
                >

                <button
                    type="button"
                    wire:click="agregarProducto"
                    class="rounded-r-lg bg-verde-salvia px-4
                            font-medium text-blanco-calido hover:bg-verde-salvia-claro"
                >
                    Agregar
                </button>

            </div>

            @error('cantidad')
                <p class="mt-1 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror
        </div>
    </div>
    
    <div class="rounded-xl border border-linea-exterior-tabla bg-blanco-calido">
        <table class="w-full border-collapse">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
                    text-center sticky">
                <tr>        
                    <th class="p-2 font-medium capitalize">indice</th>
                    <th class="p-2 font-medium capitalize">Producto</th>
                    <th class="p-2 font-medium capitalize">precio unitario</th>
                    <th class="p-2 font-medium capitalize">cantidad</th>
                    <th class="p-2 font-medium capitalize">subtotal</th>
                    <th class="p-2 font-medium capitalize">eliminar</th>
                </tr>
            </thead>

            <tbody id="productos-container">
                @forelse ($this->productosPaginados() as $index => $producto)
                    <tr
                        wire:key="producto-{{ $producto['id_producto'] }}-{{ $index }}"
                        class="bg-blanco-calido hover:bg-crema-clarisimo border-b
                            border-gris-calido-claro/50 transition-all
                            text-center text-xs"
                    >
                        <td class="p-1 text-center ">
                            {{ $index + 1 }}

                            <input
                                type="hidden"
                                name="productos[{{ $index }}][codigo]"
                                wire:model="productos.{{ $index }}.codigo"
                            >

                            <input
                                type="hidden"
                                name="productos[{{ $index }}][id_producto]"
                                value="{{ $producto['id_producto'] }}"
                            >
                        </td>

                        <td class="p-1 text-center ">
                            <input
                                type="text"
                                name="productos[{{ $index }}][nombre]"
                                value="{{ $producto['nombre'] }}"
                                readonly
                                class="w-full px-3 py-2 text-sm text-gris-calido-oscuro"
                            >
                        </td>

                        <td class="p-1 text-center ">
                            <input
                                type="text"
                                name="productos[{{ $index }}][precio_unitario]"
                                value="{{ $producto['precio_unitario'] }}"
                                readonly
                                class="w-full px-3 py-2 text-sm text-gris-calido-oscuro"
                            >
                        </td>

                        <td class="p-1 text-center ">
                            <input type="text" name="productos[{{ $index }}][cantidad]" class="w-full px-3.5 py-2.5 
                            text-sm text-gris-calido-oscuro" 
                            wire:model.live='productos.{{ $index }}.cantidad'
                            wire:change.prevent='calcularSubtotal({{ $index }})'>
                        </td>

                        <td class="p-1 text-center ">
                            <input type="text" name="productos[{{ $index }}][subtotal]" step="0.1" class="w-full px-3.5 py-2.5 
                            text-sm text-gris-calido-oscuro" wire:model='productos.{{ $index }}.subtotal'
                            readonly value="{{ number_format($producto['subtotal'], 2, ',', '.') }}">
                        </td>

                        <td class="p-1 text-center ">
                            <button
                                type="button"
                                wire:click="eliminarProducto({{ $index }})"
                                class="text-lg text-gris-suave hover:text-terracota-oscuro cursor-pointer"
                                @disabled(count($productos) === 1)
                            >
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="flex flex-col items-center justify-center gap-3 p-5">
                                <x-lucide-package-search class="w-8 h-8 text-gris-suave"/>

                                <div class="text-center">
                                    <b class="text-gris-calido-oscuro">
                                        Aún no hay productos
                                    </b>

                                    <p class="text-gris-calido-claro">
                                        Busca un producto para comenzar la venta.
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if (count($productos) > $porPagina)
        <div class="mt-2 flex items-center justify-between">
            <button
                type="button"
                wire:click='cambiarPagina({{ $paginaActual - 1}})'
                @disabled($paginaActual <= 1)
                class="rounded-md border border-gris-suave px-3 py-2 disabled:opacity-50 bg-gris-calido-claro 
                hover:bg-gris-suave cursor-pointer">

                <x-lucide-chevron-left class="w-6 h-6 text-blanco-calido"/>

            </button>

            <span class="text-sm">
                pagina {{ $paginaActual }} de {{ max(1, ceil(count($productos) / $porPagina)) }}
            </span>

            <button 
                type="button"
                wire:click='cambiarPagina({{ $paginaActual + 1 }})'
                @disabled($paginaActual >= max(1, ceil(count($productos) / $porPagina)))
                class="rounded-md border border-gris-suave px-3 py-2 disabled:opacity-50 bg-gris-calido-claro 
                hover:bg-gris-suave cursor-pointer">

                <x-lucide-chevron-right class="w-6 h-6 text-blanco-calido"/>
            </button>
        </div>
    @endif
</div>
