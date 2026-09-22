<header
    class="sticky top-0 z-30 flex h-18 items-center justify-between border-b 
        border-linea-nav bg-blanco-santorini
        px-6 backdrop-blur">

    <div class="flex items-center gap-4">

        {{-- Botón sidebar --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="flex h-10 w-10 items-center justify-center rounded-lg border border-neutral-300
                    text-gris-calido-oscuro bg-gray-400
                    hover:text-white cursor-pointer transition-all">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>


    {{-- Usuario --}}
    <div class="flex items-center gap-4">

        <a
            class="flex h-10 w-10 items-center justify-center rounded-sm hover:text-gris-calido-claro 
            cursor-pointer transition-all text-2xl text-gris-calido-oscuro">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-full bg-verde-salvia">
                U
            </div>

            <div class="hidden md:block">

                <p class="text-sm font-semibold text-gris-calido-oscuro">
                    Usuario
                </p>

                <p class="text-xs text-gris-calido-oscuro">
                    Administrador
                </p>

            </div>

        </div>

    </div>

</header>