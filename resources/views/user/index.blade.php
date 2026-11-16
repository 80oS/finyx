@extends('layouts.app')

@section('titulo', 'usuarios')

@section('content')
    @if (session('success'))
        <div id="success-message" class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="flex items-center justify-start gap-3">
            <div>
                <i><x-lucide-users-round class="w-8 h-8 text-verde-suave"/></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
                    Usuarios
                </h1>
            </div>
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('registro.create') }}" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>index</th>
                    <th>usuario</th>
                    <th>rol</th>
                    <th>asignar rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @forelse ($user->roles as $rol)
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700">
                                    {{ $rol->name }}
                                </span>
                            @empty
                                <span class="text-gray-400">
                                    Sin rol asignado
                                </span>
                            @endforelse
                        </td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base p-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection