@extends('layouts.app')

@section('titulo', 'crear categoria')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full mt-10 max-w-lg bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro capitalize text-center">
                    nueva categoria
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
            
            <form action="{{ route('categoria.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nombre</label>
                    <input type="text" name="nombre" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">descripcion</label>
                    <input type="text" name="descripcion" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">estado</label>
                    <select name="estado" id="" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        <option value="1">activo</option>
                        <option value="0">inactivo</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-calido-claro">
                    <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                    >Guardar</button>
                    <a href="{{ route('categoria.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-5 py-2.5 text-right transition-all"
                    >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection