@extends('layouts.app')

@section('titulo', 'crear compra')

@section('content') <div class="flex items-center justify-center px-4"> <div class="w-full max-w-lg bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">

        <div class="mb-6">
            <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                nueva compra
            </h2>
        </div>

        @if($errors->any())
            <div class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('compra.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2">

                {{-- Columna izquierda --}}
                <div class="mr-5">

                    <div class="mb-5">
                        <label for="id_proveedor"
                            class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                            Proveedor
                        </label>

                        <select name="id_proveedor" id="id_proveedor"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">

                            <option value="">Seleccione un proveedor</option>

                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}"
                                    {{ old('id_proveedor') == $proveedor->id ? 'selected' : '' }}>
                                    {{ $proveedor->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div class="mb-5">
                        <label for="metodo_pago"
                            class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                            Método de pago
                        </label>

                        <select name="metodo_pago" id="metodo_pago"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">

                            <option value="">Seleccione un método de pago</option>

                            <option value="efectivo"
                                {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>
                                Efectivo
                            </option>

                            <option value="tarjeta"
                                {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>
                                Tarjeta
                            </option>

                            <option value="transferencia"
                                {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>
                                Transferencia
                            </option>

                        </select>
                    </div>

                </div>


                {{-- Columna derecha --}}
                <div>

                    <div class="mb-5">
                        <label for="total"
                            class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                            Total
                        </label>

                        <input type="number"
                            step="0.01"
                            name="total"
                            id="total"
                            value="{{ old('total') }}"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                    </div>


                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-calido-claro">

                        <button type="submit"
                            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer">
                            Guardar
                        </button>

                        <a href="{{ route('compra.index') }}"
                            class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-5 py-2.5 text-right transition-all">
                            Cancelar
                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection
