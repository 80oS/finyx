@extends('layouts.app')

@section('titulo', 'Editar impuesto')

@section('content')

    <div class="flex items-center justify-center px-4">

        <div class="w-full max-w-2xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg p-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold tracking-tight text-gray-800">
                    Modificar impuesto
                </h2>
            </div>

            <form action="{{ route('impuesto.update', $impuesto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <div class="">
                        <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nombre del impuesto</label>
                        <input type="text" name="nombre" value="{{ $impuesto->nombre }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                    </div>
                    @error('nombre')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                    <div class="flex items-center gap-3 my-5">
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Codigo</label>
                            <input type="text" name="codigo" value="{{ $impuesto->codigo }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        @error('codigo')
                            <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                {{ $message }}
                            </p>
                        @enderror
                        </div>
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Tipo de impuesto</label>
                            <select name="tipo_impuesto" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                <option value="iva"{{ $impuesto->tipo_impuesto == 'IVA' ? 'selected' : '' }}>IVA</option>
                                <option value="impuesto"{{ $impuesto->tipo_impuesto == 'impuesto' ? 'selected' : '' }}>Impuesto al consumo</option>
                                <option value="otro"{{ $impuesto->tipo_impuesto == 'otro' ? 'selected' : '' }}>otro</option>
                            </select>
                            @error('tipo_impuesto')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Tipo de calculo</label>
                            <select name="tipo_calculo" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                <option value="porcentaje"{{ $impuesto->tipo_impuesto == 'porcentaje' ? 'selected' : '' }}>porcentaje</option>
                                <option value="valor fijo"{{ $impuesto->tipo_impuesto == 'valor fijo' ? 'selected' : '' }}>valor fijo</option>
                            </select>
                            @error('tipo_calculo')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Tarifa</label>
                            <input type="number" name="porcentaje" value="{{ $impuesto->porcentaje }}" step="0.01" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                            @error('porcentaje')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ $impuesto->fecha_inicio }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                            @error('fecha_inicio')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Feacha de finalizacion</label>
                            <input type="date" name="fecha_fin" value="{{ $impuesto->fecha_fin }}" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                            @error('fecha_fin')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                estado
                            </label>
                            <input type="hidden" name="estado" value="0">
                            <input type="checkbox" name="estado" value="{{ $impuesto->estado }}" @checked(old('estado', true) === true)
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
                        guardar
                    </button>
                    <a href="{{ route('impuesto.index') }}" class="bg-gris-calido-claro 
                                hover:bg-gris-calido-oscuro text-blanco-calido 
                                rounded-sm px-2 py-2.5 text-center transition-all">
                        cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection