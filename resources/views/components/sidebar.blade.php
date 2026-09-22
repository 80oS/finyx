<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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

        <span
            x-show="sidebarOpen"
            x-transition
            class="ml-3 text-xl font-bold text-gris-calido-oscuro">
            FINYX
        </span>

    </div>


    {{-- Menú --}}
    <nav class="mt-6 px-3">
        <p
            x-show="sidebarOpen"
            class="mb-3 px-3 text-xs uppercase tracking-wider text-gris-calido-oscuro">
            Menu
        </p>

        {{-- Dashboard --}}
        
        <a href="{{ route('producto.index') }}"
        
        class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all 
        {{ request()->routeIs('producto.index') 
        ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
        : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
            <i class="fa-solid fa-cart-shopping"></i>
            <span x-show="sidebarOpen" x-transition>productos</span>
        </a>

        <a href="{{ route('categoria.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
        {{ request()->routeIs('categoria.index') 
        ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
        : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
            <i class="fa-solid fa-layer-group"></i>
            <span x-show="sidebarOpen" x-transition>categorias</span>
        </a>

        <a href="{{ route('proveedores.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
        {{ request()->routeIs('proveedores.index') 
        ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
        : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
            <i class="fa-solid fa-truck"></i>
            <span x-show="sidebarOpen" x-transition>proveedores</span>
        </a>

        <a href="{{ route('cliente.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
        {{ request()->routeIs('cliente.index') 
        ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
        : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
            <i class="fa-solid fa-users pr-3"></i>
            <span x-show="sidebarOpen" x-transition>Cliente</span>
        </a>
        <a href="{{ route('compra.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize bg-aluminio px-3 py-3 hover:bg-oscuro transition-all">
            <i class="fa-solid fa-bag-shopping pr-3"></i>
            <span x-show="sidebarOpen" x-transition>Compra</span>
        </a>

        <a href="{{ route('venta.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize px-3 py-3 transition-all
        {{ request()->routeIs('venta.index') 
        ? 'bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido hover:text-blanco-calido' 
        : 'text-gris-calido-oscuro bg-sidebar-item-rest hover:bg-sidebar-item-hover hover:text-gris-calido-claro' }}">
            <i class="fa-solid fa-coins"></i>
            <span x-show="sidebarOpen" x-transition>Ventas</span>
        </a>

    </nav>

</aside>