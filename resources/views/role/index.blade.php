@extends('layouts.app')

@section('titulo', 'roles')

@section('content')
    @if (session('success'))
        <div id="success-message" class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-5">
        <div class="flex items-center justify-start gap-3">
            <div>
                <i><x-lucide-user-round-shield class="w-8 h-8 text-verde-suave"/></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
                    Roles
                </h1>
            </div>
        </div>
        <div class="flex items-end justify-end">
            <a href="" 
            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>

        <div class="dt-container">
            <table class="datatable" id="tablePrins">
                <thead>
                    <tr>
                        <th>index</th>
                        <th>Rol</th>
                        <th>Detalles</th>
                        <th>Asignar permisos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $rol)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                <button type="button">
                                    permisos
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('rol.edit', $rol->id) }}" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base p-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection