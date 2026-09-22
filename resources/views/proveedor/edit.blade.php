@extends('layout.app')

@section('titulo', 'editar proveedor')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                    Editar proveedor "{{ $proveedor->nombre }}"
                </h2>
            </div>

            <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2">
                    <div class="mr-5">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nit</label>
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="nit" value="{{ $proveedor->nit }}">
                        </div>

                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Cedula</label>
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="cedula" value="{{ $proveedor->cedula }}">
                        </div>

                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Nombre</label>
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="nombre" value="{{ $proveedor->nombre }}">
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Telefono</label>
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="telefono" value="{{ $proveedor->telefono }}">
                        </div>

                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Dirección</label>
                            <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="direccion" value="{{ $proveedor->direccion }}">
                        </div>

                        <div class="mb-5">
                            <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">Correo</label>
                            <input type="email" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco focus:border-linea-foco transition-all"
                            name="correo" value="{{ $proveedor->correo }}">
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-calido-claro">
                            <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                            >Guardar</button>
                            <a href="{{ route('proveedores.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-sm px-5 py-2.5 text-right transition-all"
                            >Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection