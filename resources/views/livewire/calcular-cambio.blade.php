<div class="mb-5">
    <label for="metodo_pago" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">metodo de pago</label>
    <select name="metodo_pago" id="metodo_pago" wire:model.live='metodoPago'
    class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
        <option value="tarjeta">tarjeta</option>
        <option value="efectivo">efectivo</option>
        <option value="transferencia">transferencia</option>
    </select>
    @if($metodoPago === 'efectivo')
        <div class="mt-1 w-full p-5 overflow-hidden rounded-lg border 
            border-gris-calido-claro bg-white shadow-lg">
            <div>
                <label for="montoRecibido"
                class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                Monto Recibido</label>
                <input
                    type="number"
                    id="montoRecibido"
                    name="montoRecibido"
                    wire:model.live.debounce.300ms="montoRecibido"
                    min="0"
                    step="1"
                    placeholder="Ej. 50000"
                    class="w-full px-3.5 py-2.5 border border-linea-input rounded-lg text-sm 
                    focus:outline-none focus:ring-2 focus:ring-linea-foco"
                >
            </div>
            <div  class="flex justify-between text-sm">
                <span class="text-gris-calido-oscuro">
                    Total de la factura
                </span>
                <span class="font-medium">
                    ${{ number_format((float) $totalFactura, 0, ',', '.') }}
                </span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gris-calido-oscuro">
                    Cambio
                </span>

                <span class="font-semibold text-green-700">
                    ${{ number_format($this->cambio, 0, ',', '.') }}
                </span>
            </div>

            @if ($montoRecibido !== '' && (float) $montoRecibido < (float) $totalFactura)
                <p class="text-sm text-red-600">
                    Faltan ${{ number_format($this->faltante, 0, ',', '.') }}
                    para completar el pago.
                </p>
            @elseif ($montoRecibido !== '' && (float) $montoRecibido >= (float) $totalFactura)
                <p class="text-sm text-green-700">
                    Pago suficiente.
                </p>
            @endif
        </div>
    @endif
</div>
