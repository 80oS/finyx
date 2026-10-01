@extends('layouts.app')

@section('titulo', 'ubicacion producto')

@section('content')
    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
            Productos
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('ubicacion.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="rounded-md">
        <table class="w-full text-left border-collapse border border-linea-exterior-tabla">
            <thead class="bg-lino-natural text-gris-marron-calido capitalize text-sm 
            text-center sticky border-b border-linea-thead">
                <tr>
                    <th class="px-3 py-3 font-medium"></th>
                    <th class="px-3 py-3 font-medium"></th>
                    <th class="px-3 py-3 font-medium"></th>
                    <th class="px-3 py-3 font-medium"></th>
                    <th class="px-3 py-3 font-medium"></th>
                    <th class="px-3 py-3 font-medium"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-blanco-calido hover:bg-crema-clarisimo transition-all border 
                    border-linea-tr-tbody text-center text-xs">
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                    <td class="p-3"></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection