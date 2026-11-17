@extends('layouts.app')

@section('titulo', 'lista de producto')

@section('content')

@if (session('success'))
<div id="success-message"
    class=" bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="grid grid-cols-2 gap-5 mb-5">
    <div class="text-2xl font-bold tracking-tight text-foreground text-gris-calido-oscuro">
        Productos
    </div>
    @can('producto.crear')
        <div class="flex items-end justify-end">
            <a href="{{ route('producto.create') }}"
                class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-5 py-1 text-right transition-all w-20">crear</a>
        </div>
    @endcan
</div>

<div class="dt-container">
    <table class="datatable" id="tablePrins">
        <thead>
            <tr>
                <th>id</th>
                <th>nombre</th>
                <th>codigo</th>
                <th>codigo de barras</th>
                <th>precio unitario</th>
                <th>stock</th>
                <th>fecha de vencimiento</th>
                <th>estado</th>
                <th>categoria</th>
                @can('producto.editar')
                    <th>Editar</th>
                @endcan
                @can('producto.changeState')
                    <th>cambiar estado</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>
                    <p class="text-gris-grafito">
                        {{ $producto->nombre }}
                    </p>

                    <p class="text-estalactita-cueva">
                        {{ $producto->categoria->nombre }}
                    </p>
                </td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->barcode }}</td>
                <td>{{ $producto->precio_unitario }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->fecha_vencimiento }}</td>
                <td>{{ $producto->estado == 1 ? 'disponible' : 'agotado' }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                @can ('producto.editar')
                    <td>
                        <a href="{{ route('producto.edit', $producto->id) }}" class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                        text-base px-5 py-1 transition-all">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                    </td>
                @endcan
                @can('producto.changeState')
                    <td>
                        <form action="{{ route('producto.changeState', $producto->id) }}" method="POST">
                            @csrf
                            @if ($producto->estado == 1)
                            <button type="submit" class="bg-terracota-suave hover:bg-terracota-oscuro 
                                                        text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer">
                                desabilitar</button>
                            @else
                            <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro 
                                                        text-blanco-calido rounded-sm px-2 py-1 transition-all cursor-pointer">
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