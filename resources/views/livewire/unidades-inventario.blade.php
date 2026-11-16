<div wire:poll.5s.keep-alive class="rounded-2xl border border-linea-exterior-tabla bg-blanco-calido p-4 shadow-sm transition hover:shadow-md">
    <div class="flex items-center gap-3">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#465D4A] text-white">
            <i class="fa-solid fa-boxes-stacked text-lg"></i>
        </div>
        <div>
            <p class="text-xs font-semibold text-gris-grafito">Unidades en inventario</p>
            <p class="text-xs text-gray-500">Existencias actuales</p>
        </div>
    </div>

    <div class="mt-4 rounded-xl bg-this px-4 py-3">
        <p class="text-3xl font-bold text-gris-grafito">{{ number_format($totalUnidades) }}</p>
        <p class="mt-1 text-xs text-gray-500">Unidades disponibles</p>
    </div>
</div>