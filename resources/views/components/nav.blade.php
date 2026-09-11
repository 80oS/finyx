<header
    class="sticky top-0 z-30 flex h-18 items-center justify-between border-b 
        border-neutral-400 bg-rey #9BAEEE;
        px-6 backdrop-blur">

    <div class="flex items-center gap-4">

        {{-- Botón sidebar --}}
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="flex h-10 w-10 items-center justify-center rounded-lg border border-neutral-300
                    text-white bg-duke -#00009C;
                    hover:text-white cursor-pointer">
            ☰
        </button>
    </div>


    {{-- Usuario --}}
    <div class="flex items-center gap-4">

        <a
            class="flex h-10 w-10 items-center justify-center rounded-sm hover:text-gray-600 
            cursor-pointer transition-all text-2xl">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>

        <div class="flex items-center gap-3">

            <div
                class="flex h-10 w-10 items-center justify-center rounded-full bg-duke -#00009C text-white font-bold">
                U
            </div>

            <div class="hidden md:block">

                <p class="text-sm font-[Montserrat] font-semibold  text-noche">
                    Usuario
                </p>

                <p class="text-xs text-noche">
                    Administrador
                </p>

            </div>

        </div>

    </div>

</header>