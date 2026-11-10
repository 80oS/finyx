<div x-data="{ open: false }"
     class="w-full rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm">

   
    <div class="mb-3 flex items-center justify-between gap-3">

        <div class="min-w-0">
            <h2 class="text-sm font-bold text-gris-grafito">
                Más vendidos
            </h2>

            <p class="mt-1 text-xs text-gris-grafito">
                {{ $total }} productos ordenados por ventas
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" @click="open = !open"
                    class="flex h-9 w-9 shrink-0 cursor-pointer items-center justify-center rounded-xl border border-linea-exterior-tabla transition hover:bg-rositai hover:text-blanco-calido"
                    :class="open ? 'bg-rosita text-blanco-calido' : 'bg-rositaf text-white'"
                    aria-label="Filtrar">
                <i class="fa-solid fa-filter text-sm"></i>
            </button>
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-this text-rositai">
                <i class="fa-solid fa-arrow-trend-up text-sm"></i>
            </div>

        </div>

    </div>

    <div x-show="open" x-transition class="mb-3 rounded-xl border border-linea-exterior-tabla p-3">

        <div class="flex flex-wrap items-end gap-3">

            <div class="min-w-[120px] flex-1">
                <label class="mb-1 block text-xs font-medium text-gris-grafito">Mes</label>
                <select wire:model.live="mes"
                        class="w-full rounded-lg border border-linea-exterior-tabla bg-blanco-calido p-2 text-xs text-gris-grafito">
                    <option value="">Todos</option>
                    @foreach(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] as $i => $nombre)
                        <option value="{{ $i + 1 }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-28">
                <label class="mb-1 block text-xs font-medium text-gris-grafito">Año</label>
                <select wire:model.live="anio"
                        class="w-full rounded-lg border border-linea-exterior-tabla bg-blanco-calido p-2 text-xs text-gris-grafito">
                    <option value="">Todos</option>
                    @foreach($anios as $a)
                        <option value="{{ $a }}">{{ $a }}</option>
                    @endforeach
                </select>
            </div>

            <button type="button" wire:click="limpiar"
                    class="cursor-pointer pb-2 text-xs text-gris-grafito hover:underline">
                Limpiar
            </button>

        </div>

    </div>


    @if($masVendidos->count() > 0)

        <div class="space-y-2">

            @foreach($masVendidos as $producto)

                <div class="flex items-center justify-between gap-3 rounded-xl border-rosita bg-rosita p-3">

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
                            {{ $producto->total_vendido ?? 0 }} vendidas
                        </p>

                        <p class="mt-1 text-xs text-gris-grafito">
                            #{{ $desde + $loop->index }}
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
                    hover:bg-rositai hover:text-blanco-calido disabled:cursor-not-allowed 
                    disabled:opacity-40 cursor-pointer"
                    aria-label="Página anterior">

                    <i class="fa-solid fa-chevron-left"></i>

                </button>

                @foreach($paginas as $i => $n)

                    @if($i > 0 && $n - $paginas[$i - 1] > 1)
                        <span class="px-1 text-xs text-rositai">
                            ...
                        </span>
                    @endif

                    <button
                        wire:click="irA({{ $n }})"
                        class="rounded-lg px-2.5 py-1.5 text-xs transition-rositai cursor-pointer
                            {{ $n === $pagina
                                ? 'bg-rosita font-bold text-blanco-calido'
                                : 'text-gris-grafito hover:text-blanco-calido hover:bg-rositai' }}">

                        {{ $n }}

                    </button>

                @endforeach

                <button
                    wire:click="siguiente"
                    @disabled($pagina >= $ultimaPagina)
                    class="rounded-lg px-2 py-1.5 text-xs text-gris-grafito transition 
                    hover:text-blanco-calido hover:bg-rositai disabled:cursor-not-allowed 
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

        
        <div class="rounded-xl border-rosita bg-rosita px-3 py-5 text-center">

            <i class="fa-solid fa-chart-simple mb-2 text-xl text-gris-grafito"></i>

            <p class="text-xs font-semibold text-gris-grafito">
                Aún no hay ventas registradas.
            </p>

            <p class="mt-1 text-xs text-gris-grafito">
                Los productos aparecerán cuando registres ventas.
            </p>

        </div>

    @endif

</div>
