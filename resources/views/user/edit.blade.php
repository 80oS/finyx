@extends('layouts.app')

@section('titulo', 'asignar-role')

@section('content')
    <div class="flex items-center justify-center pt-10">
        <div class="w-full max-w-xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="flex flex-row items-center justify-center gap-3 mb-5 border-b border-gris-suave/50 pb-3">
                <div>
                    <i><x-lucide-pen-line class="w-8 h-8 text-verde-suave"/></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                        Asignar Rol al usuario "{{ $user->name }}"
                    </h2>
                </div>
            </div>

            <form action="{{ route('user.role', $user->id) }}" method="POST">
                @csrf

                <div class="my-5">
                    <label for=""class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                        Rol
                    </label>
                    <select name="rol" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        <option value="">elige un rol</option>
                        @foreach ($roles as $rol)
                            @if ($rol->name !== 'Desarrollador')
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-suave/50">
                    <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-lg cursor-pointer transition-all px-2 py-2">
                        Asignar
                    </button>
                    <a href="{{ route('user.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-lg transition-all px-2 py-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection