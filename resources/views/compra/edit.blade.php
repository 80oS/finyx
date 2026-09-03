@extends('layout.app')

@section('titulo', 'editar compra')

@section('content')
    <div class="flex items-center justify-center px-4">
        <div class="w-full max-w-lg bg-slate-200 border border-slate-800 rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-slate-800 capitalize">
                    Editar compra {{ $compra->nombre }}
                </h2>
            </div>

            <form action="{{ route('compra.update', $compra->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="metodo_pago" class="block text-sm font-medium text-slate-800 mb-1.5">metodo pago</label>

                    <select name="metodo_pago" id="metodo_pago" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">Seleccione un método de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                    </select>
                </div>

                 <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Total</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                    name="total" value="{{ $compra->total }}">
                </div>

                 <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Proveedor</label>
                    <select name="id_proveedor" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">Seleccione un proveedor</option>

                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ $compra->id_proveedor == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>



                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-500">
                     <button type="submit" class="bg-emerald-700 hover:bg-emerald-900 text-white rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer">Guardar</button>
                     <a href="{{ route('compra.index') }}" class="bg-slate-700 hover:bg-slate-800 text-white rounded-sm px-5 py-2.5 text-right transition-all">Cancelar</a>
                </div>

            </form>
        </div>
    </div>
@endsection


