<div x-data="{ open: false }"
     class="w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

    <div class="mb-3 flex items-center justify-between gap-3">

        <div class="min-w-0">
            <h2 class="text-sm font-bold text-gris-grafito">
                Alertas de stock
            </h2>

            <p class="mt-1 text-xs text-gris-grafito">
                {{ $total }} productos con existencias bajas
            </p>
        </div>

        <div class="flex items-center gap-2">

            <button type="button" @click="open = !open"
                    class="flex h-9 w-9 shrink-0 cursor-pointer items-center justify-center rounded-xl border border-linea-exterior-blanco transition hover:bg-mentai hover:text-blanco-calido"
                    :class="open ? 'bg-menta text-blanco-calido' : 'bg-mentaf text-white'"
                    aria-label="Filtrar">
                <i class="fa-solid fa-filter text-sm"></i>
            </button>

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-this text-mentai">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i>
            </div>

        </div>

    </div>

    <div x-show="open" x-transition class="mb-3 rounded-xl border border-linea-exterior-tabla p-3">

        <div class="flex flex-wrap items-end gap-3">

            <div class="min-w-[150px] flex-1">
                <label class="mb-1 block text-xs font-medium text-gris-grafito">Filtrar por</label>
                <select wire:model.live="filtro"
                        class="w-full rounded-lg border border-linea-exterior-tabla bg-blanco-calido p-2 text-xs text-gris-grafito">
                    <option value="promedio">Stock menor e igual a 5</option>
                    <option value="agotados">Agotados</option>
                    <option value="todos">Todos</option>
                </select>
            </div>

            @if($filtro === 'valor')
                <div class="w-24">
                    <label class="mb-1 block text-xs font-medium text-gris-grafito">Stock</label>
                    <input type="number" min="0"
                           wire:model.live.debounce.400ms="valor"
                           placeholder="Ej: 10"
                           class="w-full rounded-lg border border-linea-exterior-tabla bg-blanco-calido p-2 text-xs text-gris-grafito">
                </div>
            @endif

            <button type="button" wire:click="$set('filtro', 'promedio')"
                    class="cursor-pointer pb-2 text-xs text-gris-grafito hover:underline">
                Limpiar
            </button>
        </div>
    </div>

    @if($productos->count() > 0)

        <div class="space-y-2">

            @foreach($productos as $producto)

                <div class="flex items-center justify-between gap-3 rounded-xl border-menta 
                bg-menta p-3">

                    <div class="min-w-0">
                        <h3 class="truncate text-xs font-semibold text-gris-grafito">
                            {{ $producto->nombre }}
                        </h3>

                        <p class="mt-1 text-xs text-gris-grafito">
                            Código: {{ $producto->codigo }}
                        </p>
                    </div>

                    <div class="ml-2 shrink-0 text-right">

                        <p class="text-xs font-bold text-gris-grafito">
                            {{ $producto->stock }} unidades
                        </p>

                        <p class="mt-1 text-xs text-gris-grafito">
                            Mínimo: 5
                        </p>

                    </div>

                </div>

            @endforeach

        </div>


        @if($ultimaPagina > 1)

            @php
                $paginas = collect([1, $ultimaPagina])
                    ->merge(range(
                        max(1, $pagina - 1),
                        min($ultimaPagina, $pagina + 1)
                    ))
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            <div class="flex items-center justify-center gap-1 pt-4">

                <button
                    wire:click="anterior"
                    @disabled($pagina <= 1)
                    class="rounded-lg px-2 py-1.5 text-xs text-gris-grafito transition 
                    hover:bg-mentai hover:text-blanco-calido disabled:cursor-not-allowed disabled:opacity-40 cursor-pointer"
                    aria-label="Página anterior">

                    <i class="fa-solid fa-chevron-left"></i>

                </button>

                @foreach($paginas as $i => $n)

                    @if($i > 0 && $n - $paginas[$i - 1] > 1)
                        <span class="px-1 text-xs text-gris-grafito">
                            ...
                        </span>
                    @endif

                    <button
                        wire:click="irA({{ $n }})"
                        class="rounded-lg px-2.5 py-1.5 text-xs transition cursor-pointer
                            {{ $n === $pagina
                                ? 'bg-menta font-bold text-blanco-calido'
                                : 'text-gris-grafito hover:text-blanco-calido hover:bg-mentai' }}">

                        {{ $n }}

                    </button>

                @endforeach

                <button
                    wire:click="siguiente"
                    @disabled($pagina >= $ultimaPagina)
                    class="rounded-lg px-2 py-1.5 text-xs text-gris-grafito transition 
                    hover:bg-mentai hover:text-blanco-calido disabled:cursor-not-allowed 
                    disabled:opacity-40 cursor-pointer"
                    aria-label="Página siguiente">

                    <i class="fa-solid fa-chevron-right"></i>

                </button>

            </div>

            <p class="pt-1 text-center text-xs text-gris-grafito">
                Página {{ $pagina }} de {{ $ultimaPagina }}
            </p>

        @endif


    @else

        <div class="rounded-xl border border-menta bg-menta px-3 py-5 text-center">

            <i class="fa-solid fa-circle-check mb-2 text-xl text-gris-grafito"></i>

            <p class="text-xs font-semibold text-gris-grafito">
                No hay productos con stock bajo.
            </p>

            <p class="mt-1 text-xs text-gris-grafito">
                Existencias suficientes.
            </p>

        </div>

    @endif

</div>