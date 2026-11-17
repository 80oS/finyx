<aside 
    class="fixed left-0 top-0 z-40 h-screen border-r border-linea-sidebar/60 bg-porcelana-fina 
           transition-all duration-300 ease-in-out flex flex-col shadow-xs"
    :class="sidebarOpen ? 'w-64' : 'w-20'"
>

    {{-- LOGO & MARCA (Misma altura h-16 que el header) --}}
    <div class="flex h-16 items-center border-b border-linea-sidebar/40 transition-all duration-300"
         :class="sidebarOpen ? 'px-5 justify-start' : 'px-0 justify-center'">

        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            {{-- Icono F con sombra y sutil anillo --}}
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-verde-salvia 
                        font-black text-sm text-blanco-calido shadow-xs ring-2 ring-verde-salvia/20 
                        transition-transform group-hover:scale-105">
                F
            </div>

            {{-- Nombre de la marca --}}
            <span
                x-show="sidebarOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-x-2"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="text-lg font-black tracking-widest text-gris-calido-oscuro">
                FINYX
            </span>
        </a>

    </div>


    {{-- MENÚ DE NAVEGACIÓN CON SCROLL SUAVE --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 px-3 space-y-1.5 select-none">
        
        <p
            x-show="sidebarOpen"
            x-transition
            class="px-3 mb-2 text-[10px] font-bold uppercase tracking-wider text-estalactita-cueva">
            Navegación
        </p>

        {{-- 1. GRUPO: PRODUCTOS --}}
        @php
            $isProductosActive = request()->routeIs('producto.*', 'ubicacion.*', 'categoria.*', 'impuesto.*');
        @endphp
        <div x-data="{ abierto: {{ $isProductosActive ? 'true' : 'false' }} }" class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :title="!sidebarOpen ? 'Productos' : ''"
                class="flex items-center w-full p-2.5 rounded-xl font-medium text-xs transition-all cursor-pointer {{ $isProductosActive ? 'text-gris-calido-oscuro bg-lino-natural/50 font-semibold' : 'text-gris-calido-oscuro/85 hover:bg-lino-natural/40 hover:text-gris-calido-oscuro' }}"
                :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                
                <span class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-5 h-5 shrink-0">
                        <x-lucide-boxes class="h-5 w-5 {{ $isProductosActive ? 'text-verde-salvia' : 'text-gris-calido-oscuro' }}"/>
                    </span>
                    <span x-show="sidebarOpen" x-transition class="capitalize text-xs">productos</span>
                </span>

                <i
                    x-show="sidebarOpen"
                    class="fa-solid fa-chevron-down text-[10px] text-estalactita-cueva transition-transform duration-200"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            {{-- Submenú --}}
            <div 
                x-cloak
                x-show="sidebarOpen && abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l border-linea-input/60 pl-2.5 space-y-1">

                @can('producto.ver')
                    <a href="{{ route('producto.index') }}"
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('producto.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-cart-shopping text-xs w-4 text-center"></i>
                        <span>productos</span>
                    </a>
                @endcan

                @can('ubicacion.ver')
                    <a href="{{ route('ubicacion.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('ubicacion.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-location-dot text-xs w-4 text-center"></i>
                        <span>ubicaciones</span>
                    </a>
                @endcan

                @can('categoria.ver')
                    <a href="{{ route('categoria.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('categoria.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-layer-group text-xs w-4 text-center"></i>
                        <span>categorias</span>
                    </a>
                @endcan

                @can('impuesto.ver')
                    <a href="{{ route('impuesto.index') }}"
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('impuesto.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <span class="w-4 flex justify-center"><x-lucide-badge-percent class="h-3.5 w-3.5"/></span>
                        <span>impuestos</span>
                    </a>
                @endcan
            </div>
        </div>


        {{-- 2. GRUPO: PROVEEDORES --}}
        @php
            $isProveedoresActive = request()->routeIs('proveedores.*', 'compra.*');
        @endphp
        <div x-data="{ abierto: {{ $isProveedoresActive ? 'true' : 'false' }} }" class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :title="!sidebarOpen ? 'Proveedores' : ''"
                class="flex items-center w-full p-2.5 rounded-xl font-medium text-xs transition-all cursor-pointer {{ $isProveedoresActive ? 'text-gris-calido-oscuro bg-lino-natural/50 font-semibold' : 'text-gris-calido-oscuro/85 hover:bg-lino-natural/40 hover:text-gris-calido-oscuro' }}"
                :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                
                <span class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-5 h-5 shrink-0">
                        <x-lucide-van class="h-5 w-5 {{ $isProveedoresActive ? 'text-verde-salvia' : 'text-gris-calido-oscuro' }}"/>
                    </span>
                    <span x-show="sidebarOpen" x-transition class="capitalize text-xs">proveedores</span>
                </span>

                <i
                    x-show="sidebarOpen"
                    class="fa-solid fa-chevron-down text-[10px] text-estalactita-cueva transition-transform duration-200"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            <div 
                x-cloak
                x-show="sidebarOpen && abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l border-linea-input/60 pl-2.5 space-y-1">
            
                @can('proveedor.ver')
                    <a href="{{ route('proveedores.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('proveedores.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-truck text-xs w-4 text-center"></i>
                        <span>proveedores</span>
                    </a>
                @endcan

                @can('compra.ver')
                    <a href="{{ route('compra.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('compra.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-bag-shopping text-xs w-4 text-center"></i>
                        <span>compras</span>
                    </a>
                @endcan
            </div>
        </div>


        {{-- 3. GRUPO: FACTURACIÓN --}}
        @php
            $isFacturacionActive = request()->routeIs('cliente.*', 'venta.*');
        @endphp
        <div x-data="{ abierto: {{ $isFacturacionActive ? 'true' : 'false' }} }" class="relative">

            <button
                type="button"
                @click="abierto = !abierto"
                :title="!sidebarOpen ? 'Facturación' : ''"
                class="flex items-center w-full p-2.5 rounded-xl font-medium text-xs transition-all cursor-pointer {{ $isFacturacionActive ? 'text-gris-calido-oscuro bg-lino-natural/50 font-semibold' : 'text-gris-calido-oscuro/85 hover:bg-lino-natural/40 hover:text-gris-calido-oscuro' }}"
                :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                
                <span class="flex items-center gap-3">
                    <span class="flex items-center justify-center w-5 h-5 shrink-0">
                        <x-lucide-receipt class="h-5 w-5 {{ $isFacturacionActive ? 'text-verde-salvia' : 'text-gris-calido-oscuro' }}"/>
                    </span>
                    <span x-show="sidebarOpen" x-transition class="capitalize text-xs">facturación</span>
                </span>

                <i
                    x-show="sidebarOpen"
                    class="fa-solid fa-chevron-down text-[10px] text-estalactita-cueva transition-transform duration-200"
                    :class="{ 'rotate-180': abierto }"></i>
            </button>

            <div 
                x-cloak
                x-show="sidebarOpen && abierto"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="ml-5 mt-1 border-l border-linea-input/60 pl-2.5 space-y-1">

                @can('cliente.ver')
                    <a href="{{ route('cliente.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('cliente.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-address-book text-xs w-4 text-center"></i>
                        <span>clientes</span>
                    </a>
                @endcan

                @can('facturas.ver')
                    <a href="{{ route('venta.index') }}" 
                       class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('venta.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                        <i class="fa-solid fa-coins text-xs w-4 text-center"></i>
                        <span>ventas</span>
                    </a>
                @endcan
            </div>
        </div>


        {{-- 4. GRUPO: CONFIGURACIÓN --}}
        @can('configuracion')
            @php
                $isConfigActive = request()->routeIs('user.*', 'rol.*');
            @endphp
            <div x-data="{ abierto: {{ $isConfigActive ? 'true' : 'false' }} }" class="relative">

                <button
                    type="button"
                    @click="abierto = !abierto"
                    :title="!sidebarOpen ? 'Configuración' : ''"
                    class="flex items-center w-full p-2.5 rounded-xl font-medium text-xs transition-all cursor-pointer {{ $isConfigActive ? 'text-gris-calido-oscuro bg-lino-natural/50 font-semibold' : 'text-gris-calido-oscuro/85 hover:bg-lino-natural/40 hover:text-gris-calido-oscuro' }}"
                    :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                    
                    <span class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-5 h-5 shrink-0">
                            <x-lucide-settings class="h-5 w-5 {{ $isConfigActive ? 'text-verde-salvia' : 'text-gris-calido-oscuro' }}"/>
                        </span>
                        <span x-show="sidebarOpen" x-transition class="capitalize text-xs">configuración</span>
                    </span>

                    <i
                        x-show="sidebarOpen"
                        class="fa-solid fa-chevron-down text-[10px] text-estalactita-cueva transition-transform duration-200"
                        :class="{ 'rotate-180': abierto }"></i>
                </button>

                <div 
                    x-cloak
                    x-show="sidebarOpen && abierto"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="ml-5 mt-1 border-l border-linea-input/60 pl-2.5 space-y-1">

                    @can('usuarios.ver')
                        <a href="{{ route('user.index') }}" 
                           class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('user.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                            <i class="fa-solid fa-users text-xs w-4 text-center"></i>
                            <span>usuarios</span>
                        </a>
                    @endcan

                    @can('roles.ver')
                        <a href="{{ route('rol.index') }}" 
                           class="flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-xs transition-all capitalize {{ request()->routeIs('rol.index') ? 'bg-verde-salvia text-blanco-calido font-semibold shadow-xs' : 'text-gris-calido-oscuro hover:bg-lino-natural/60' }}">
                            <span class="w-4 flex justify-center"><x-lucide-user-round-shield class="h-3.5 w-3.5"/></span>
                            <span>roles</span>
                        </a>
                    @endcan
                </div>
            </div>
        @endcan

    </nav>
</aside>