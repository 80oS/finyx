@extends('layouts.app')

@section('titulo', 'lista de producto')

@section('content')

    @if (session('success'))
        <div id="success-message" class="bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5 items-center">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
            Productos
        </div>

        <div class="flex items-center justify-end gap-3">
            <!-- BOTÓN DESPLEGABLE DE FILTRO -->
            <div class="relative inline-block text-left">
                <button 
                    type="button" 
                    id="filtroBoton"
                    onclick="toggleFiltroMenu(event)"
                    title="Filtrar productos"
                    class="flex items-center justify-center w-9 h-8 rounded-sm border transition-all cursor-pointer {{ request('estado') !== null ? 'bg-gris-calido-oscuro text-blanco-calido border-gris-calido-oscuro' : 'bg-blanco-calido text-gris-calido-oscuro border-linea-input hover:bg-gris-calido-claro/20' }}">
                    <i class="fa-solid fa-filter text-sm"></i>
                </button>

                <!-- Menú desplegable -->
                <div 
                    id="filtroMenu" 
                    class="hidden absolute right-0 mt-2 w-48 bg-blanco-calido border border-linea-input rounded-lg shadow-lg py-1.5 z-50">
                    
                    <div class="px-3 py-1.5 text-xs font-semibold text-estalactita-cueva border-b border-linea-input/50 uppercase tracking-wider">
                        Filtrar por estado
                    </div>

                    {{-- Todos --}}
                    <a href="{{ route('producto.index') }}" 
                       class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors hover:bg-gris-calido-claro/20 {{ request('estado') === null ? 'text-gris-calido-oscuro font-bold bg-gris-calido-claro/10' : 'text-gris-calido-oscuro' }}">
                        <span>Todos</span>
                        @if (request('estado') === null)
                            <i class="fa-solid fa-check text-xs"></i>
                        @endif
                    </a>

                    {{-- Disponibles / Habilitados (1) --}}
                    <a href="{{ route('producto.index', ['estado' => 1]) }}" 
                       class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors hover:bg-verde-salvia/10 {{ request('estado') === '1' ? 'text-verde-salvia font-bold bg-verde-salvia/10' : 'text-gris-calido-oscuro' }}">
                        <span>Disponibles (Habilitados)</span>
                        @if (request('estado') === '1')
                            <i class="fa-solid fa-check text-xs text-verde-salvia"></i>
                        @endif
                    </a>

                    {{-- Agotados / Deshabilitados (0) --}}
                    <a href="{{ route('producto.index', ['estado' => 0]) }}" 
                       class="flex items-center justify-between px-3 py-2 text-xs font-medium transition-colors hover:bg-terracota-suave/10 {{ request('estado') === '0' ? 'text-terracota-suave font-bold bg-terracota-suave/10' : 'text-gris-calido-oscuro' }}">
                        <span>Agotados (Deshabilitados)</span>
                        @if (request('estado') === '0')
                            <i class="fa-solid fa-check text-xs text-terracota-suave"></i>
                        @endif
                    </a>
                </div>
            </div>

            <!-- BOTÓN CREAR -->
            <a href="{{ route('producto.create') }}" 
               class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-center transition-all w-20">
               crear
            </a>
        </div>
    </div>

    <!-- TABLA -->
    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                    <th>codigo</th>
                    <th>codigo de barras</th>
                    <th>precio unitario</th>
                    <th>stock</th>
                    <th>fecha de vencimiento</th>
                    <th>estado</th>
                    <th>categoria</th>
                    <th>Editar</th>
                    <th>cambiar estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>
                            <p class="text-gris-grafito">
                                {{ $producto->nombre }}
                            </p>
                            
                            <p class="text-estalactita-cueva text-xs">
                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                            </p>
                        </td>
                        <td>{{ $producto->codigo }}</td>
                        <td>{{ $producto->barcode }}</td>
                        <td>{{ $producto->precio_unitario }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->fecha_vencimiento }}</td>
                        <td>
                            @if ($producto->estado == 1)
                                <span class="text-xs px-2 py-0.5 rounded bg-verde-salvia/20 text-verde-salvia font-semibold">disponible</span>
                            @else
                                <span class="text-xs px-2 py-0.5 rounded bg-terracota-suave/20 text-terracota-suave font-semibold">agotado</span>
                            @endif
                        </td>
                        <td>{{ $producto->categoria->nombre ?? '' }}</td>
                        <td>
                            <a href="{{ route('producto.edit', $producto->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('producto.changeState', $producto->id) }}" method="POST">
                                @csrf
                                @if ($producto->estado == 1)
                                    <button type="submit"
                                    class="bg-terracota-suave hover:bg-terracota-oscuro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer text-xs">
                                        deshabilitar</button>
                                @else
                                    <button type="submit"
                                    class="bg-verde-salvia hover:bg-verde-salvia-claro 
                                    text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer text-xs">
                                        habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center py-4 text-gris-calido-oscuro">
                            No hay productos con este estado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Script simple para abrir/cerrar el menú desplegable -->
    <script>
        function toggleFiltroMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('filtroMenu');
            menu.classList.toggle('hidden');
        }

        // Cierra el menú al hacer clic en cualquier parte fuera
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('filtroMenu');
            const boton = document.getElementById('filtroBoton');
            if (menu && !menu.contains(event.target) && !boton.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
@endsection