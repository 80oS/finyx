@extends('layouts.app')

@section('titulo', 'Detalle del impuesto')

@section('content')
    <div class="flex items-center gap-5 mb-5">
        <div>
            <a href="{{ route('impuesto.index') }}">
                <x-lucide-chevron-left class="w-6 h-6 text-gris-calido-oscuro hover:text-gris-suave"/>
            </a>
        </div>
        <div>
            <label for="" class="uppercase text-gris-suave font-bold text-sm">Inventario</label>
            <h1 class="capitalize text-gris-calido-oscuro font-bold text-lg">Detalle de Impuesto</h1>
        </div>
    </div>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-4xl border border-blanco-calido shadow shadow-gris-calido-claro
            rounded-lg p-3">
            <div class="dt-container">
                <table class="datatable" id="tablePrins">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>impuesto</th>
                            <th>valor</th>
                            <th>producto</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($impuesto->productoImpuesto as $index => $asigna)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $impuesto->nombre }}</td>
                                <td>{{ $asigna->tarifa_aplicada }}</td>
                                <td>{{ $asigna->producto->nombre }}</td>
                                <td>{{ $asigna->producto->categoria->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection