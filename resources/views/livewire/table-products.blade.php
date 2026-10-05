<div>
    <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-2 py-1 font-medium">id</th>
                    <th class="px-2 py-1 font-medium">nombre</th>
                    <th class="px-2 py-1 font-medium">codigo</th>
                    <th class="px-2 py-1 font-medium">codigo de barras</th>
                    <th class="px-2 py-1 font-medium">precio unitario</th>
                    <th class="px-2 py-1 font-medium">stock</th>
                    <th class="px-2 py-1 font-medium">fecha de vencimiento</th>
                    <th class="px-2 py-1 font-medium">estado</th>
                    <th class="px-2 py-1 font-medium">categoria</th>
                    <th class="px-2 py-1 font-medium">Editar</th>
                    <th class="px-2 py-1 font-medium">cambiar estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                        <td class="p-3">{{ $producto->id }}</td>
                        <td class="p-3">
                            <p class="text-gris-grafito">
                                {{ $producto->nombre }}
                            </p>
                            
                            <p class="text-estalactita-cueva">
                                {{ $producto->categoria->nombre }}
                            </p>
                        </td>
                        <td class="p-3">{{ $producto->codigo }}</td>
                        <td class="p-3">{{ $producto->barcode }}</td>
                        <td class="p-3">{{ $producto->precio_unitario }}</td>
                        <td class="p-3">{{ $producto->stock }}</td>
                        <td class="p-3">{{ $producto->fecha_vencimiento }}</td>
                        <td class="p-3">{{ $producto->estado == 1 ? 'disponible' : 'agotado' }}</td>
                        <td class="p-3">{{ $producto->categoria->nombre }}</td>
                        <td class="p-3">
                            <a href="{{ route('producto.edit', $producto->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="p-2">
                            <form action="{{ route('producto.changeState', $producto->id) }}" method="POST">
                                @csrf
                                @if ($producto->estado == 1)
                                    <button type="submit"
                                    class="bg-terracota-suave hover:bg-terracota-oscuro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer">
                                        desabilitar</button>
                                @else
                                    <button type="submit"
                                    class="bg-verde-salvia hover:bg-verde-salvia-claro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer">
                                        habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">
                            No hay productos registrados.
                        </td>
                    </tr>
                @endforelse 
            </tbody>
        </table>
    <div class="mt-2">
        {{ $productos->links() }}
    </div>
</div>
