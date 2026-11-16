@extends('layouts.app')

@section('titulo', 'Lista de Compras')

@section('content')

    @if (session('success'))
        <div id="success-message" class="bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
    <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
        Compras
    </div>
    <div class="flex items-end justify-end gap-2">
        <a href="{{ route('compras.historial') }}"
            class="bg-verde-salvia hover:bg-verde-salvia text-blanco-calido
                rounded-sm px-5 py-1 text-center transition-all">
            <i class="fa-solid fa-clock-rotate-left"></i> Historial
        </a>

        <a href="{{ route('compra.create') }}"
            class="bg-verde-salvia hover:bg-verde-salvia text-blanco-calido
                rounded-sm px-5 py-1 text-right transition-all w-20">
            crear
        </a>
    </div>
</div>

    <div class="dt-container">
        <table class="datatable" id="tablePrins">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Proveedor</th>
                    <th>Metodo pago</th>
                    <th>Total</th>
                    <th>Acciones</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->proveedor->nombre }}</td>
                        <td>{{ $compra->metodo_pago}}</td>
                        <td>{{ $compra->total }}</td>
                        <td>
                            <a href="{{ route('compra.edit', $compra->id) }}"
                                class="text-azul-grisaceo hover:text-azul-grisaceo-oscuro 
                                text-base px-5 py-1 transition-all">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection