@extends('layouts.app')

@section('titulo', 'Asignar impuesto productos')

@section('content')
    @if($errors->any())
            <div class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  
    <div class="flex items-center justify-center">
        <div class="w-full max-w-4xl border border-blanco-calido shadow shadow-gris-calido-claro
            rounded-lg p-3">
            <div class="text-start">
                <h1 class="font-bold text-gris-calido-oscuro">
                    Asignacion de Impuestos
                </h1>
                <p class="text-gris-calido-claro">
                    Administra la configuracion tributaria de tus productos.
                </p>
            </div>
                
            <form action="{{ route('impuesto.producto', $impuesto->id) }}" method="POST">
                @csrf

                <div x-data="asignacionImpuesto(
                    '{{ route('categorias.productos', ['categoria' => '__ID__']) }}'
                )" class="space-y-5">

                    {{-- Botones para cambiar el modo --}}
                    <div class="flex items-center gap-4">
                        <button
                            type="button"
                            @click="modo = 'categoria'"
                            :class="modo === 'categoria'
                                ? 'bg-azul-grisaceo-oscuro text-white'
                                : 'bg-azul-grisaceo text-white'"
                            class="p-2 w-full rounded-sm cursor-pointer"
                        >
                            Por categoría
                        </button>

                        <button
                            type="button"
                            @click="modo = 'producto'"
                            :class="modo === 'producto'
                                ? 'bg-azul-grisaceo-oscuro text-white'
                                : 'bg-azul-grisaceo text-white'"
                            class="p-2 w-full rounded-sm cursor-pointer"
                        >
                            Por producto
                        </button>
                    </div>

                    {{-- Selector de categoría --}}
                    <div x-show="modo === 'categoria'">
                        <livewire:productos-categoria :impuesto-id="$impuesto->id"/>
                    </div>

                    {{-- Selector de producto --}}
                    <div x-show="modo === 'producto'" class="my-5">
                        <label for="" class="block text-sm font-medium mb-2">
                            Seleccionar Producto
                        </label>

                        <select
                            name="productos[0][id_producto]"
                            :required="modo === 'producto'"
                            :disabled="modo !== 'producto'"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco transition-all">
                            <option value="">Seleccionar producto</option>

                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">
                                    {{ $producto->nombre }} - {{ $producto->id }} - {{ $producto->categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('productos.*.id_producto')
                            <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <input type="hidden" name="tarifa_aplicada" value="{{ $impuesto->porcentaje }}" class="border" readonly>

                <div class="">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                        Fecha Inicio
                    </label>
                    <input type="date" name="fecha_inicio" value="{{ $impuesto->fecha_inicio }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                    @error('fecha_inicio')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="my-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                        Fecha Fin
                    </label>
                    <input type="date" name="fecha_fin" value="{{ $impuesto->fecha_fin }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                    @error('fecha_fin')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                        Estado
                    </label>
                    <input type="hidden" name="estado" value="0">
                    <input type="checkbox" name="estado" value="1" @checked(old('estado', true) === true)
                    class="h-5 w-5 accent-verde-salvia-claro border-verde-salvia-claro rounded">

                    @error('estado')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 pt-4 border-t border-gris-suave/50">
                    <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido 
                            rounded-sm px-2 py-2.5 text-center transition-all cursor-pointer">
                        Asignar impuesto
                    </button>
                    <a href="{{ route('impuesto.index') }}" class="bg-gris-calido-claro 
                            hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-2 py-2.5 text-center 
                            transition-all">
                        cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection