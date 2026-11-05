<div>
    <button type="button" wire:click='abrirModal'
        class="bg-ambar-claro hover:bg-ambar-oscuro rounded p-2 capitalize 
        text-blanco-calido cursor-pointer">
        ver ubicaciones hijas
    </button>

    @if ($modalAbierto)
        <div class="fixed inset-0 flex items-center justify-center bg-gris-calido-oscuro/50 z-50 transition-all">
            <div class="bg-blanco-calido rounded-lg p-6 w-96">
                <div class="mb-5 text-end">
                    <button type="button" wire:click='cerrarModal' class="cursor-pointer">
                        <x-lucide-x class="h-5 w-5 text-gris-calido-claro hover:text-terracota-oscuro" />
                    </button>
                </div>

                <div class="my-5">
                    <h1 class="capitalize text-gris-calido-oscuro text-center">
                        Ubicaciones hijas de {{ $ubicacion->nombre }}
                    </h1>
                </div>

                <div class="border border-linea-exterior-tabla rounded-lg">
                    <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
                        <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm text-center sticky border-b border-linea-thead">
                            <tr>
                                <th class="px-2 py-2 font-medium">Index</th>
                                <th class="px-2 py-2 font-medium">Nombre</th>
                                <th class="px-2 py-2 font-medium">Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ubicacion->hijo as $index => $hija)
                                <tr class="bg-blanco-calido transition-all border 
                                            border-linea-tr-tbody text-center text-xs">
                                    <td class="p-2">{{ $index + 1 }}</td>
                                    <td class="p-2">{{ $hija->nombre }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('ubicacion.show', $hija->id) }}" class="text-ambar-claro hover:text-ambar-oscuro p-1 text-base">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
