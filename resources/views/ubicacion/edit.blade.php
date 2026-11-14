@extends('layouts.app')

@section('titulo', 'Editar Ubicacion')

@section('content')
    <div class="flex items-center justify-center pt-10">
        <div class="w-full max-w-3xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="flex flex-row items-center justify-center gap-3 mb-5 border-b border-gris-suave/50 pb-3">
                <div>
                    <i><x-lucide-map-pin-pen class="w-8 h-8 text-verde-suave"/></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                        Edidar ubicacion
                    </h2>
                </div>
            </div>

            <form action="{{ route('ubicacion.update', $ubicacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                tipo de ubicacion
                            </label>
                            <select type="text" name="tipo" class="tom-select">
                                <option value="estanteria">Estanteria</option>
                                <option value="bodega">Bodega</option>
                                <option value="nevera">nevera</option>
                            </select>

                            @error('tipo')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                nombre
                            </label>
                            <input type="text" name="nombre" placeholder="Ej. Estantería A1" value="{{ $ubicacion->nombre }}"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                            @error('nombre')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                codigo
                            </label>
                            <input type="text" name="codigo" value="{{ $ubicacion->codigo }}" 
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input 
                            rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 
                            focus:ring-linea-foco focus:border-linea-foco transition-all">
                            @error('codigo')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                ubicacion principal
                            </label>
                            <select type="text" name="id_ubicacion_padre" class="tom-select">
                                <option
                                    value=""
                                    @selected(old('id_ubicacion_padre', $ubicacion->id_ubicacion_padre) == '')>
                                    Sin ubicación padre (principal)
                                </option>
                                @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" {{ $ubicacion->id_ubicacion_padre == $ubicacion->id ? 'selected' : '' }}>
                                        {{ $ubicacion->nombre }}({{ $ubicacion->codigo }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_ubicacion_padre')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-row items-center justify-center mb-5 gap-3">
                            <div>
                                <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                    capacidad
                                </label>
                                <input type="text" name="capacidad" value="{{ $ubicacion->capacidad }}"
                                class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                @error('capacidad')
                                    <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                    unidad
                                </label>
                                <input type="text" name="unidad_capacidad" value="{{ $ubicacion->unidad_capacidad }}"
                                class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                
                                @error('unidad_capacidad')
                                <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                                    {{ $message }}
                                </p>
                            @enderror
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                descripcion
                            </label>
                            <input type="text" name="descripcion" value="{{ $ubicacion->descripcion }}"
                            class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                                estado
                            </label>
                            <input type="hidden" name="estado" value="inactiva">
                            <input type="checkbox" name="estado" value="activa" @checked(old('estado', 'activa') === 'activa')
                            class="h-5 w-5 accent-verde-salvia-claro border-verde-salvia-claro rounded">
                        </div>
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-suave/50">
                            <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-lg cursor-pointer transition-all px-2 py-2">
                                Guardar
                            </button>
                            <a href="{{ route('ubicacion.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-lg transition-all px-2 py-2">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection