@extends('layout.app')

@section('titulo', 'crear producto')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="mb-5">
                <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                    nuevo producto
                </h2>
            </div>

            @if($errors->any())
                <div class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('producto.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2">
                    <div class="mr-5">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nombre</label>
                            <input type="text" name="nombre" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Codigo</label>
                            <input type="text" name="codigo" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Codigo de Barras</label>
                            <input type="text" name="barcode" autofocus class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Precio Unitario</label>
                            <input type="number" step="0.1" name="precio_unitario" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">stock</label>
                            <input type="number" name="stock" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                    </div>
                    <div class="">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Fecha de Vencimiento</label>
                            <input type="date" name="fecha_vencimiento" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Ubicacion Real</label>
                            <input type="text" name="ubicacion_real" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Esado</label>
                            <select name="estado" id="estado" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                <option value="1">disponible</option>
                                <option value="0">agotado</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Categoria</label>
                            <select name="id_categoria" id="id_categoria" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-calido-claro">
                            <button type="submit" 
                            class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-lg cursor-pointer transition-all px-2 py-2">
                            Guardar</button>
                            <a href="{{ route('producto.index') }}" 
                            class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-lg transition-all px-2 py-2">
                            Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection