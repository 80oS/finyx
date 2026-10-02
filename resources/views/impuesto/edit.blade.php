@extends('layouts.app')

@section('titulo', 'Editar impuesto')

@section('content')


<div class="flex items-center justify-center px-4">

    <div class="w-full max-w-lg bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg p-8">

        <div class="mb-6">
            <h2 class="text-2xl font-bold tracking-tight text-gray-800">Editar impuesto</h2>

            <p class="text-sm text-gray-500 mt-1"> Modifica los datos del impuesto.</p>
        </div>

        <form action="{{ route('impuesto.update', $impuesto->id) }}" method="POST">

            @csrf
            @method('PUT')

            
            <div class="mb-5">
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $impuesto->nombre) }}" placeholder="Ej. IVA general" class="w-full border border-gray-300 rounded-lg px-4 py-2focus:outline-none focus:ring-2 focus:ring-verde-salvia">

            </div>
            
            <div class="mb-5">
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700 mb-2"> Fecha de inicio </label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $impuesto->fecha_inicio) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2focus:outline-none focus:ring-2 focus:ring-verde-salvia">
            </div>

            <div class="mb-5">
                <label for="fecha_fin" class="block text-sm font-medium text-gray-700 mb-2">Fecha de fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="{{ old('fecha_fin', $impuesto->fecha_fin) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-verde-salvia">
            </div>

            <div class="mb-6">
               <label for="porcentaje" class="block text-sm font-medium text-gray-700 mb-2">Porcentaje (%)</label>
                <input type="number" name="porcentaje" id="porcentaje" value="{{ old('porcentaje', $impuesto->porcentaje) }}"step="0.01" min="0" max="50" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-verde-salvia">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('venta.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-5 py-2 transition-all">Cancelar </a>
                <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-lg px-5 py-2 transition-all"> Actualizar</button>
            </div>

        </form>

    </div>

</div>

@endsection
