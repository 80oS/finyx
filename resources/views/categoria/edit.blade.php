@extends('layout.app')

@section('titulo', 'editar categoria')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-slate-200 border border-slate-800 rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-slate-800 capitalize">
                    Editar Categoria {{ $categoria->nombre }}
                </h2>
            </div>

            <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Nombre</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="nombre" value="{{ $categoria->nombre }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Descripcion</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="descripcion" value="{{ $categoria->descripcion }}">
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">estado</label>
                    <select name="estado" id="" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="1" {{ $categoria->estado == 1 ? 'selected' : '' }}>activo</option>
                        <option value="0" {{ $categoria->estado == 0 ? 'selected' : '' }}>inactivo</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-500">
                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-900 text-white rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                    >Guardar</button>
                    <a href="{{ route('categoria.index') }}" class="bg-slate-700 hover:bg-slate-800 text-white rounded-sm px-5 py-2.5 text-right transition-all"
                    >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection