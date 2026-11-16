
@extends('layouts.app')

@section('titulo', 'Acceso denegado')

@section('content')

<div class="min-h-[75vh] flex items-center justify-center px-4">

    <div class="max-w-lg w-full text-center">

        {{-- Icono --}}
        <div class="flex justify-center mb-6">
            <div class="w-24 h-24 rounded-full bg-red-50
                        flex items-center justify-center">
                <x-lucide-shield-x
                    class="w-12 h-12 text-red-500"
                />
            </div>
        </div>

        {{-- Código --}}
        <h1 class="text-7xl font-bold text-gris-calido-oscuro">
            403
        </h1>

        <h2 class="text-2xl font-semibold mt-4 text-gris-calido-oscuro">
            Acceso denegado
        </h2>

        <p class="text-gray-500 mt-3 leading-relaxed">
            No tienes los permisos necesarios para acceder
            a este recurso o realizar esta acción.
            Si consideras que se trata de un error,
            comunícate con el administrador del sistema.
        </p>

        {{-- Botones --}}
        <div class="flex items-center justify-center gap-3 mt-8">

            <a href="{{ url()->previous() }}"
                class="px-5 py-2.5 rounded-lg border border-gray-300
                        text-gray-600 hover:bg-gray-100 transition">
                Volver
            </a>

            <a href="{{ url('/') }}"
                class="px-5 py-2.5 rounded-lg bg-azul-grisaceo
                        text-white hover:bg-azul-grisaceo-oscuro
                        transition">
                Ir al inicio
            </a>

        </div>

    </div>

</div>

@endsection
