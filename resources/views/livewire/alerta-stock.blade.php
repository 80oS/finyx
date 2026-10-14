<div class="bg-white rounded-xl shadow-sm p-3 w-full max-w-xs">

    <div class="flex items-center justify-between mb-2">

        <div>
            <h2 class="text-base font-bold text-gray-800">
                Alertas de stock
            </h2>

            <p class="text-xs text-gray-500">
                {{ $total }} productos con existencias bajas
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

        {{-- Paginación --}}
        @if($ultimaPagina > 1)
            @php
                $paginas = collect([1, $ultimaPagina])
                    ->merge(range(max(1, $pagina - 1), min($ultimaPagina, $pagina + 1)))
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            <div class="flex items-center justify-center gap-1 pt-3">

                <button wire:click="anterior"
                        @disabled($pagina <= 1)
                        class="px-2 py-1 text-xs text-gray-600 disabled:opacity-40">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                @foreach($paginas as $i => $n)
                    @if($i > 0 && $n - $paginas[$i - 1] > 1)
                        <span class="text-xs text-gray-400">...</span>
                    @endif

                    <button wire:click="irA({{ $n }})"
                            class="px-2 py-1 text-xs rounded
                                {{ $n === $pagina
                                    ? 'bg-red-100 text-red-600 font-bold'
                                    : 'text-gray-600 hover:bg-gray-100' }}">
                        {{ $n }}
                    </button>
                @endforeach

                <button wire:click="siguiente"
                        @disabled($pagina >= $ultimaPagina)
                        class="px-2 py-1 text-xs text-gray-600 disabled:opacity-40">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

            </div>

            <p class="text-center text-xs text-gray-400 pt-1">
                Página {{ $pagina }} de {{ $ultimaPagina }}
            </p>
        @endif

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