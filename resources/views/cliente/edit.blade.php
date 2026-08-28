@extends('layout.app')

@section('titulo', 'editar cliente')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-slate-200 border border-slate-800 rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-slate-800 capitalize">
                    Editar Cliente {{ $cliente->nombre }}
                </h2>
            </div>

            <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Nombre</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="nombre" value="{{ $cliente->nombre }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Cedula</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="cedula" value="{{ $cliente->cedula }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Telefono</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="telefono" value="{{ $cliente->telefono }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Correo</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="correo" value="{{ $cliente->correo }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Direccion</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="direccion" value="{{ $cliente->direccion }}">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-500">
                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-900 text-white rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                    >Guardar</button>
                    <a href="{{ route('cliente.index') }}" class="bg-slate-700 hover:bg-slate-800 text-white rounded-sm px-5 py-2.5 text-right transition-all"
                    >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection