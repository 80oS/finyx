<div>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold text-slate-800">Historial de compras</h2>

        <a href="{{ route('compra.index') }}"
           class="bg-verde-salvia text-blanco-calido rounded-sm px-5 py-1 transition-all">
            Volver
        </a>
    </div>

    <div class="mb-4 flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-sm text-gray-600 mb-1">Filtrar por</label>
            <select wire:model.live="tipo"
                    class="rounded-lg border border-gray-200 bg-white px-3 py-2 outline-none focus:border-[#6b8f71]">
                <option value="mes">Mes</option>
                <option value="fecha">Fecha</option>
            </select>
        </div>

        <div wire:key="filtro-{{ $tipo }}">
            <label class="block text-sm text-gray-600 mb-1">
                {{ $tipo === 'mes' ? 'Selecciona el mes' : 'Selecciona la fecha' }}
            </label>
            <input type="{{ $tipo === 'mes' ? 'month' : 'date' }}" wire:model.live="valor"
                   class="rounded-lg border border-gray-200 bg-white px-3 py-2 outline-none focus:border-[#6b8f71]">
        </div>

        <button wire:click="limpiar"
                class="rounded px-3 py-2 text-gray-600 hover:bg-gray-100">
            Limpiar
        </button>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
        <table class="w-full text-center">
            <thead class="bg-[#e8dfcf] text-slate-700">
                <tr>
                    <th class="py-3">Id</th>
                    <th class="py-3">Proveedor</th>
                    <th class="py-3">Método de pago</th>
                    <th class="py-3">Total</th>
                    <th class="py-3">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $c)
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="py-3">{{ $c->id }}</td>
                        <td class="py-3">{{ $c->nombre }}</td>
                        <td class="py-3 capitalize">{{ $c->metodo_pago }}</td>
                        <td class="py-3">{{ $c->total }}</td>
                        <td class="py-3">{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-gray-500">No hay compras</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex items-center justify-end gap-3">
        <button wire:click="anterior" @disabled($pagina == 1)
                class="rounded px-3 py-1 text-gray-600 hover:bg-gray-100 disabled:opacity-40">
            Anterior
        </button>
        <span class="rounded bg-[#6b8f71] px-3 py-1 text-white">{{ $pagina }}</span>
        <button wire:click="siguiente"
                class="rounded px-3 py-1 text-gray-600 hover:bg-gray-100">
            Siguiente
        </button>
    </div>
</div>