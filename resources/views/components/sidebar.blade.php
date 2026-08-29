<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<aside class="fixed left-0 top-0 z-40 h-screen border-r border-neutral-400 bg-neutral-200 
    transition-all duration-300"
    :class="sidebarOpen ? 'w-64' : 'w-20'"
>

    {{-- Logo --}}
    <div class="flex h-18 items-center px-5">

        <div
            class="flex h-9 w-9 shrink-0
                    items-center justify-center
                    rounded-lg bg-green-700
                    font-bold">
            I
        </div>

        <span
            x-show="sidebarOpen"
            x-transition
            class="ml-3 text-xl font-bold">
            Inventario
        </span>

    </div>


    {{-- Menú --}}
    <nav class="mt-6 px-3">
        <p
            x-show="sidebarOpen"
            class="mb-3 px-3 text-xs uppercase tracking-wider">
            Menu
        </p>

        {{-- Dashboard --}}
        
        <a href="{{ route('producto.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize bg-indigo-500/20 px-3 py-3 hover:bg-indigo-200/30 transition-all">
            <i class="fa-solid fa-cart-shopping"></i>
            <span x-show="sidebarOpen" x-transition>productos</span>
        </a>
        <a href="{{ route('categoria.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize bg-indigo-500/20 px-3 py-3 hover:bg-indigo-200/30 transition-all">
            <i class="fa-solid fa-layer-group"></i>
            <span x-show="sidebarOpen" x-transition>categorias</span>
        </a>
        <a href="{{ route('proveedores.index') }}" 
        class="mb-2 flex items-center gap-3 rounded-lg capitalize bg-indigo-500/20 px-3 py-3 hover:bg-indigo-200/30 transition-all">
            <i class="fa-solid fa-truck"></i>
            <span x-show="sidebarOpen" x-transition>proveedores</span>
        </a>
    </nav>

</aside>