@extends('layouts.app')

@section('titulo', 'crear venta')

@section('content')
    <div class="flex items-center justify-center">
        <div class="w-full mt-4 max-w-5xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="mb-6">
                <h2 class="text-xl text-center font-semibold tracking-tight text-gris-calido-oscuro capitalize">
                    nueva venta
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

            <form action="{{ route('venta.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-3 gap-5">
                    <div class=" col-span-2">
                        <div class="mb-5">
                            <label for="id_cliente" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Cliente</label>
                            <select name="id_cliente" id="id_cliente" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Codigo de  Barras</label>
                            <input type="text" id="barcode" autofocus class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all">
                        </div>

                        <div class="mb-5">
                            <h1 class="text-center text-gris-calido-oscuro capitalize">productos</h1>

                            <hr class="my-5 text-gris-calido-claro">

                            <livewire:factura-product/>
                            
                            <div class="text-end grid grid-cols-2 gap-10 mt-2">
                                <strong>Total:</strong>

                                <span id="total">
                                    <input type="text" name="total" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all">
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">codigo factura</label>
                            <input type="text" name="codigo" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                        text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                        focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">estado factura</label>
                            <select name="estado" id="" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                <option value="pendiente">pendiente</option>
                                <option value="pagado">pagado</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">observaciones</label>
                            <input type="text" name="observaciones" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                        text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                        focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">metodo de pago</label>
                            <select name="metodo_pago" id="" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                <option value="transferencia">tarjeta</option>
                                <option value="transferencia">transferencia</option>
                                <option value="efectivo">efectivo</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-calido-claro">
                            <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                            >Guardar</button>
                            <a href="{{ route('venta.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-5 py-2.5 text-right transition-all"
                            >Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    @vite(['resources/js/factura.js'])

@endpush