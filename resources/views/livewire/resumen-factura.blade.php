<div>
    <livewire:calcular-cambio
        :total-factura="$total"
        :key="'calcular-cambio'"
    />
    
    <div class="mb-5 mt-5">
        <div class="my-5 text-gris-calido-claro">
            <label for="">Productos</label>
            <span class="float-end">
                {{ $cantidad }}
            </span>
        </div>

        <div class="grid grid-cols-1">

            <div class="grid grid-cols-2">
                <strong class="text-start text-xl">Subtotal</strong>

                <span class="text-end text-lg">
                    ${{ number_format($subtotal, 2, ',', '.') }}
                </span>
            </div>

            <div class="grid grid-cols-2">
                <strong class="text-start text-xl">Impuestos</strong>

                <span class="text-end text-lg">
                    ${{ number_format($totalImpuestos, 2, ',', '.') }}
                </span>
            </div>

            <div class="grid grid-cols-2">
                <strong class="text-start text-xl">Total a Pagar:</strong>

                <span id="total" class="text-end text-lg">
                    ${{ number_format($total, 2, ',', '.') }}
                    <input type="hidden" name="total" value="{{ $total }}">
                </span>
            </div>
        </div>
    </div>
</div>
