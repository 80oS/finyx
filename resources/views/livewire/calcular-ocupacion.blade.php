<div wire:poll.5s class="my-4">
    <div class="mb-4 flex items-center justify-between gap-3">
        <div>
            <h3 class="font-semibold text-gray-800">
                Ocupación Estimada
            </h3>

            <p class="text-sm text-gray-500">
                {{ $ubicacion->nombre }}
            </p>
        </div>

        @if ($porcentaje !== null)
            <span class="text-lg font-bold text-gray-800">
                {{ $porcentaje }}%
            </span>
        @endif
    </div>

    @if ($porcentaje !== null)
        <div
            class="h-3 w-full overflow-hidden rounded-full bg-gray-200"
            role="progressbar"
            aria-label="Ocupación de la ubicación"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-valuenow="{{ min(100, $porcentaje) }}"
        >
            <div
                class="h-full rounded-full transition-all duration-500 {{ $color }}"
                style="width: {{ $anchoBarra }}%"
            ></div>
        </div>

        <div class="mt-3 flex justify-between gap-3 text-sm text-gray-500">
            <span>
                {{ $unidades }} unidades almacenadas
            </span>

            <span>
                Capacidad: {{ $capacidad }}
            </span>
        </div>

        @if ($porcentaje >= 100)
            <p class="mt-3 text-sm font-medium text-red-600">
                La ubicación alcanzó o superó su capacidad máxima.
            </p>
        @endif
    @else
        <p class="text-sm text-gray-500">
            No se ha definido una capacidad válida para esta ubicación.
        </p>
    @endif
</div>
