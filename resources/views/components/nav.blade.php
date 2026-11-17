<header
    class="sticky top-0 z-30 flex h-16 items-center justify-between border-b 
        border-linea-nav/60 bg-blanco-santorini/85 px-6 
        backdrop-blur-md transition-all shadow-xs">

    <!-- LADO IZQUIERDO: Botón sidebar y bienvenida -->
    <div class="flex items-center gap-3.5">
        {{-- Botón sidebar moderno --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            title="Alternar menú lateral"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-linea-input/70
                   bg-blanco-calido text-gris-calido-oscuro shadow-xs
                   hover:border-verde-salvia hover:bg-verde-salvia/10 hover:text-verde-salvia 
                   active:scale-95 cursor-pointer transition-all">
            <i class="fa-solid fa-bars text-sm"></i>
        </button>

        {{-- Saludo sutil o título (opcional pero le da presencia) --}}
        <div class="hidden sm:block">
            <span class="text-xs font-semibold text-estalactita-cueva uppercase tracking-wider">
                Panel de control
            </span>
        </div>
    </div>

    <!-- LADO DERECHO: Perfil de usuario y Logout -->
    <div class="flex items-center gap-4">

        <!-- INFO DEL USUARIO -->
        <div class="flex items-center gap-3">
            {{-- Avatar dinámico con inicial y punto de estado --}}
            <div class="relative">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-verde-salvia text-blanco-calido font-bold text-sm shadow-sm ring-2 ring-verde-salvia/20">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <!-- Punto de estado activo -->
                <span class="absolute -bottom-0.5 -right-0.5 h-2.5 w-2.5 rounded-full bg-verde-salvia border-2 border-blanco-santorini"></span>
            </div>

            {{-- Nombre y rol --}}
            <div class="hidden md:block text-left">
                <p class="text-xs font-bold text-gris-calido-oscuro leading-tight">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-[11px] font-medium text-estalactita-cueva capitalize">
                    {{ auth()->user()->roles->first()->name ?? 'Usuario' }}
                </p>
            </div>
        </div>

        <!-- DIVISOR VERTICAL ELEGANTE -->
        <div class="h-5 w-px bg-gris-calido-claro/50"></div>

        <!-- BOTÓN CERRAR SESIÓN -->
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
            @csrf
            <button 
                type="submit"
                title="Cerrar sesión"
                class="flex h-9 w-9 items-center justify-center rounded-xl text-estalactita-cueva 
                       hover:text-terracota-suave hover:bg-terracota-suave/10 hover:border hover:border-terracota-suave/20
                       cursor-pointer transition-all active:scale-95">
                <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
            </button>
        </form>

    </div>

</header>