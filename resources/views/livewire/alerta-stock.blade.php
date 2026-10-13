<div class="bg-white rounded-xl shadow-sm p-3 w-full max-w-xs">

    <div class="flex items-center justify-between mb-2">

        <div>
            <h2 class="text-base font-bold text-gray-800">
                Alertas de stock
            </h2>

            <p class="text-xs text-gray-500">
                Productos con existencias bajas
            </p>
        </div>

        <div class="bg-red-100 text-red-600 rounded-full p-1.5">
            <i class="fa-solid fa-triangle-exclamation text-xs"></i>
        </div>

    </div>

    @if($productos->count() > 0)

        <div class="space-y-2">

            @foreach($productos as $producto)

                <div class="flex items-center justify-between
                            bg-red-50 border border-red-100
                            rounded-lg p-2">

                    <div class="min-w-0">
                        <h3 class="text-xs font-semibold text-gray-800 truncate">
                            {{ $producto->nombre }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            Código: {{ $producto->codigo }}
                        </p>
                    </div>

                    <div class="text-right ml-2 shrink-0">

                        <p class="text-xs text-red-600 font-bold">
                            {{ $producto->stock }} unidades
                        </p>

                        <p class="text-xs text-gray-500">
                            Mínimo: 5
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-3">

            <i class="fa-solid fa-circle-check text-green-500 text-xl mb-2"></i>

            <p class="text-xs text-gray-600 font-medium">
                No hay productos con stock bajo.
            </p>

            <p class="text-xs text-gray-400">
                Existencias suficientes.
            </p>

        </div>

    @endif

</div>
