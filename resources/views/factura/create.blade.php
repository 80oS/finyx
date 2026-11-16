@extends('layouts.app')

@section('titulo', 'crear venta')

@section('content')
    <div class="flex items-center justify-center">
        <div class="w-full mt-4 max-w-6xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-5">
            <div class="mb-6 border-b border-gris-suave/50 pb-5">
                <div class="flex items-center justify-start gap-3">
                    <div class="text-verde-salvia text-3xl bg-gray-300/50 rounded-sm p-2">
                        <x-lucide-receipt class="w-8 h-8 text-verde-salvia"/>
                    </div>
                    <h1 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro capitalize">
                        nueva venta
                    </h1>
                </div>
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

                <div class="grid grid-cols-3 gap-8">
                    <div class=" col-span-2">
                        <div class="mb-5">
                            <livewire:cliente-buscar/>
                        </div>

                        <div class="mb-5">
                            <div>
                                <h2 class="text-gris-calido-oscuro capitalize">
                                    <b>agregar productos</b>
                                </h2>
                                <p class="text-gris-calido-claro">
                                    Busca por nombre o escanea el codigo de barras.
                                </p>
                            </div>

                            <livewire:factura-product/>
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                estado factura
                            </label>
                            <select name="estado" class="tom-select selectTom selectSh">
                                <option value="pendiente">pendiente</option>
                                <option value="pagado">pagado</option>
                            </select>
                        </div>

                        <livewire:modal/>

                        <livewire:resumen-factura/>

                        <div class="flex flex-col gap-2 pt-4 border-t border-gris-suave/50">
                            <button type="submit" 
                                class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido 
                                rounded-sm px-2 py-2.5 text-center transition-all cursor-pointer"
                            >Guardar</button>
                            <a href="{{ route('venta.index') }}" class="bg-gris-calido-claro 
                                hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-2 py-2.5 text-center 
                                transition-all"
                            >Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection