<div>
    <div class="mb-4">
        <label for="" class="block text-sm font-medium mb-2">
            Seleccionar Categoria
        </label>

        <select  wire:model.live="categoriaId" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco transition-all">
            <option value="">Seleccionar Categoria</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    @if ($categoriaId !== '')

        @if ($productos->isNotEmpty())

            @foreach ($productos as $index => $producto)
                <input
                    type="hidden"
                    name="productos[{{ $index }}][id_producto]"
                    value="{{ $producto->id }}"
                    wire:key="producto-impuesto-{{ $producto->id }}"
                >
            @endforeach

            <p class="mt-3 text-sm text-gray-500">
                Productos seleccionados: {{ count($productos) }}
            </p>

        @else
            <p class="text-sm text-gray-500">
                Esta categoría no tiene productos registrados.
            </p>
        @endif

    @else
        <p class="text-sm text-gray-500">
            Selecciona una categoría para consultar sus productos.
        </p>
    @endif
    @error('productos.*.id_producto')
        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
            {{ $message }}
        </p>
    @enderror
</div>
