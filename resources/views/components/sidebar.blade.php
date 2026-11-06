<aside class="fixed left-0 top-0 z-40 h-screen border-r border-linea-sidebar bg-porcelana-fina 
    transition-all duration-300"
    :class="sidebarOpen ? 'w-64' : 'w-20'"
>

    {{-- Logo --}}
    <div class="flex h-18 items-center px-5">

        <div
            class="flex h-9 w-9 shrink-0
                    items-center justify-center
                    rounded-lg bg-verde-salvia
                    font-bold text-blanco-calido">
            F
        </div>

        <a href="{{ route('home') }}">
            <span
                x-show="sidebarOpen"
                x-transition
                class="ml-3 text-xl font-bold text-gris-calido-oscuro">
                FINYX
            </span>
        </a>

    </div>


    {{-- Menú --}}
    <nav class="mt-6 px-3">
        <p
            x-show="sidebarOpen"
            class="mb-3 px-3 text-xs uppercase tracking-wider text-gris-calido-oscuro">
            Menu
        </p>

        {{-- Dashboard --}}

        <div x-data="{abierto: false}"
            @mouseenter="abierto = true"
            class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :aria-expanded="abierto"
                class="flex items-center justify-between w-full p-3 text-gris-calido-oscuro
                        rounded-lg hover:bg-lino-natural transition-colors">
                <span class="flex items-center gap-2">
                    <i> <x-lucide-boxes class="h-6 w-6 text-gris-calido-oscuro"/> </i>
                    productos
                </span>
                <i
                    class="fa-solid fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            <div 
                x-cloak
                x-show="abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l-2 border-ambar-claro pl-3">

                <a href="{{ route('producto.index') }}"
                class="flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all 
                {{ request()->routeIs('producto.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>listado de productos</span>
                </a>

                <a href="{{ route('ubicacion.index') }}" 
                class="flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                    {{ request()->routeIs('ubicacion.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro'}}">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>ubicaciones</span>
                </a>

                <a href="{{ route('categoria.index') }}" 
                class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('categoria.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>categorias</span>
                </a>

                <a href="{{ route('impuesto.create') }}"
                    class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('impuesto.create') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                        <i class="fa-solid fa-coins"></i>
                    <span>IVA</span>
                </a>
            </div>
        </div>

        <div x-data="{abierto: false}"
            @mouseenter="abierto = true"
            class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :aria-expanded="abierto"
                class="flex items-center justify-between w-full p-3 text-gris-calido-oscuro
                        rounded-lg hover:bg-lino-natural transition-colors">
                <span class="flex items-center gap-2">
                    <i> <x-lucide-van class="h-6 w-6 text-gris-calido-oscuro"/> </i>
                    proveedores
                </span>
                <i
                    class="fa-solid fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            <div 
                x-cloak
                x-show="abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l-2 border-ambar-claro pl-3">
            
                <a href="{{ route('proveedores.index') }}" 
                class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('proveedores.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-truck"></i>
                    <span>Lista de proveedores</span>
                </a>

                <a href="{{ route('compra.index') }}" 
                class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('compra.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-bag-shopping pr-3"></i>
                    <span>Compra</span>
                </a>
            </div>
        </div>

        <div x-data="{abierto: false}"
            @mouseenter="abierto = true"
            class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :aria-expanded="abierto"
                class="flex items-center justify-between w-full p-3 text-gris-calido-oscuro
                        rounded-lg hover:bg-lino-natural transition-colors">
                <span class="flex items-center gap-2">
                    <i> <x-lucide-receipt class="h-6 w-6 text-gris-calido-oscuro"/> </i>
                    facturacion
                </span>
                <i
                    class="fa-solid fa-chevron-down text-xs transition-transform"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            <div 
                x-cloak
                x-show="abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l-2 border-ambar-claro pl-3">

                <a href="{{ route('cliente.index') }}" 
                class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('cliente.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-users pr-3"></i>
                    <span>Cliente</span>
                </a>

                <a href="{{ route('venta.index') }}" 
                class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
                {{ request()->routeIs('venta.index') 
                ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
                : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
                    <i class="fa-solid fa-coins"></i>
                    <span>Ventas</span>
                </a>
            </div>
        </div>
    </nav>
</aside>