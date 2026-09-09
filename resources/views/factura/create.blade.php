@extends('layout.app')

@section('titulo', 'crear venta')

@section('content')
    <div class="flex items-center justify-center">
        <div class="w-full max-w-4xl bg-slate-200 border border-slate-800 rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold tracking-tight text-slate-800 capitalize">
                    nueva venta
                </h2>
            </div>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <form action="{{ route('venta.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="id_cliente" class="block text-sm font-medium text-slate-800 mb-1.5">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">Codigo de  Barras</label>
                    <input type="text" id="barcode" autofocus class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                </div>

                <div class="mb-5">
                    <h1 class="text-center capitalize">productos</h1>

                    <hr class="my-5">
                    <div class="overflow-x-auto rounded-md">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                                <tr>
                                    <th class="px-3 py-3 font-medium border border-gray-800">Codigo</th>
                                    <th class="px-3 py-3 font-medium border border-gray-800">Producto</th>
                                    <th class="px-3 py-3 font-medium border border-gray-800">precio unitario</th>
                                    <th class="px-3 py-3 font-medium border border-gray-800">cantidad</th>
                                    <th class="px-3 py-3 font-medium border border-gray-800">subtotal</th>
                                </tr>
                            </thead>

                            <tbody id="productos-container" class="divide-y divide-gray-600 text-sm text-gray-900">
                                <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                                    <td class="p-3 border border-gray-800">
                                        <input type="text" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                                    </td>
                                    <td class="p-3 border border-gray-800">
                                        <input type="text" name="productos[1][id_producto]" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                                    </td>
                                    <td class="p-3 border border-gray-800">
                                        <input type="number" step="0.1" name="productos[1][precio_unitario]" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                                    </td>
                                    <td class="p-3 border border-gray-800">
                                        <input type="number" name="productos[1][cantidad]" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                                    </td>
                                    <td class="p-3 border border-gray-800">
                                        <input type="number" step="0.1" name="productos[1][subtotal]" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                            text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                            focus:border-indigo-500 transition-all">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-end">
                            <strong>Total:</strong>

                            <span id="total">
                                <input type="text" name="total" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                                text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                focus:border-indigo-500 transition-all">
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">codigo factura</label>
                    <input type="text" name="codigo" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                                text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                focus:border-indigo-500 transition-all">
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">estado factura</label>
                    <select name="estado" id="" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="pendiente">pendiente</option>
                        <option value="pagado">pagado</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">observaciones</label>
                    <input type="text" name="observaciones" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg 
                                text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                focus:border-indigo-500 transition-all">
                </div>
                <div class="mb-5">
                    <label for="" class="block text-sm font-medium text-slate-800 mb-1.5">metodo de pago</label>
                    <select name="metodo_pago" id="" class="w-full px-3.5 py-2.5 bg-slate-300 border border-slate-300 rounded-lg text-sm text-slate-800  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="transferencia">tarjeta</option>
                        <option value="transferencia">transferencia</option>
                        <option value="efectivo">efectivo</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-500">
                    <button type="submit" class="bg-emerald-700 hover:bg-emerald-900 text-white rounded-sm px-4 py-2.5 text-right transition-all cursor-pointer"
                    >Guardar</button>
                    <a href="{{ route('venta.index') }}" class="bg-slate-700 hover:bg-slate-800 text-white rounded-sm px-5 py-2.5 text-right transition-all"
                    >Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    @vite(['resources/js/factura.js'])

@endpush