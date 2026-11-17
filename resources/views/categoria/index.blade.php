@extends('layouts.app')

@section('titulo', 'Lista de Categorias')

@section('content')

    @if (session('success'))
        <div id="success-message" class="bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl tracking-tight text-gris-calido-oscuro">
            Categorias
        </div>
        @can('categoria.crear')
            <div class="flex items-end justify-end">
                <a href="{{ route('categoria.create') }}"
                    class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20">crear</a>
            </div>
        @endcan
    </div>

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    @can('categoria.editar')
                        <th>Editar</th>
                    @endcan
                    @can('categoria.changeState')
                        <th>Cambiar Estado</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $index => $categoria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>{{ $categoria->estado == 1 ? 'activo' : 'inactivo' }}</td>
                        @can('categoria.editar')
                            <td>
                                <a href="{{ route('categoria.edit', $categoria->id) }}" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                                            text-base transition-all">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                            </td>
                        @endcan
                        @can('categoria.changeState')
                            <td>
                                <form action="{{ route('categoria.changeState', $categoria->id) }}" method="POST">
                                    @csrf
                                    @if ($categoria->estado == 1)
                                    <button type="submit" class="bg-terracota-suave hover:bg-terracota-oscuro 
                                                                text-blanco-calido rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        desabilitar</button>
                                    @else
                                    <button type="submit"
                                        class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        habilitar</button>
                                    @endif
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection