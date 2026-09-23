@extends('layouts.app')

@section('titulo', 'editar compra')

@section('content') <div class="flex items-center justify-center px-4"> <div class="w-full max-w-lg bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">


        <div class="mb-6">
            <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                Editar compra
            </h2>
        </div>

        <form action="{{ route('compra.update', $compra->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2">

                {{-- Columna izquierda --}}
                <div class="mr-5">

                    <div class="mb-5">
                        <label for="metodo_pago"
                            class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                            Método de pago
                        </label>

                        <select name="metodo_pago" id="metodo_pago"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">

                            <option value="">Seleccione un método de pago</option>

                            <option value="efectivo"
                                {{ $compra->metodo_pago == 'efectivo' ? 'selected' : '' }}>
                                Efectivo
                            </option>

                            <option value="tarjeta"
                                {{ $compra->metodo_pago == 'tarjeta' ? 'selected' : '' }}>
                                Tarjeta
                            </option>

                            <option value="transferencia"
                                {{ $compra->metodo_pago == 'transferencia' ? 'selected' : '' }}>
                                Transferencia
                            </option>

                        </select>
                    </div>


                    <div class="mb-5">
                        <label for="total"
                            class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                            Total
                        </label>

                        <input type="text"
                            name="total"
                            id="total"
                            value="{{ $compra->total }}"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                    </div>

                </div>


                {{-- Columna derecha --}}
                <div>

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
                                    {{ $compra->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                    {{ $proveedor->nombre }}
                                </option>
                            @endforeach

                        </select>
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
