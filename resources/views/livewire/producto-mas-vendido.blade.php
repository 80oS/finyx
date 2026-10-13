<div class="bg-white rounded-xl shadow-sm p-3 w-full max-w-xs">

    <div class="flex items-center justify-between mb-2">

        <div>
            <h2 class="text-base font-bold text-gray-800">
                Más vendidos
            </h2>

            <p class="text-xs text-gray-500">
                Productos con más salidas
            </p>
        </div>

        <div class="bg-green-100 text-green-600 rounded-full p-1.5">
            <i class="fa-solid fa-arrow-trend-up text-xs"></i>
        </div>

    </div>

    @if($masVendidos->count() > 0)

        <div class="space-y-2">

            @foreach($masVendidos as $producto)

                <div class="flex items-center justify-between
                            bg-green-50 border border-green-100
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

                        <p class="text-xs text-green-600 font-bold">
                            {{ $producto->total_vendido ?? 0 }} vendidas
                        </p>

                        <p class="text-xs text-gray-500">
                            #{{ $loop->iteration }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="text-center py-3">

            <i class="fa-solid fa-chart-simple text-gray-400 text-xl mb-2"></i>

            <p class="text-xs text-gray-600 font-medium">
                Aún no hay ventas registradas.
            </p>

            <p class="text-xs text-gray-400">
                Aparecerán cuando registres ventas.
            </p>

        </div>

    @endif

</div>