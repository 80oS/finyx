@extends('layout.app')

@section('titulo', 'lista de producto')

@section('content')

    @if (session('success'))
        <div class=" bg-green-700/10 border border-green-400 text-gray-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 gap-5 mb-5">
        <div class="text-2xl font-bold tracking-tight text-foreground text-gray-800">
            Productos
        </div>
        <div class="flex items-end justify-end">
            <a href="{{ route('producto.create') }}" 
            class="bg-green-700 hover:bg-green-900 text-white rounded-sm px-5 py-1 text-right transition-all w-20"
            >crear</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-md">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-400 text-gray-800 uppercase text-xs text-center sticky">
                <th>
                    <td class="px-3 py-3 font-medium border border-gray-800">id</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">nombre</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">codigo</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">codigo de barras</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">precio unitario</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">stock</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">fecha de vencimiento</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">ubicacion real</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">estado</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">categoria</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">Editar</td>
                    <td class="px-3 py-3 font-medium border border-gray-800">cambiar estado</td>
                </th>
            </thead>
            <tbody class="divide-y divide-gray-600 text-sm text-gray-900">
                @foreach ($productos as $producto)
                    <tr class="bg-gray-300 hover:bg-gray-400 transition-all">
                        <td class="p-3 border border-gray-800">{{ $producto->id }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->nombre }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->codigo }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->barcode }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->precio_unitario }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->stock }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->fecha_vencimiento }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->ubicacion_real }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->estado == 1 ? 'disponible' : 'agotado' }}</td>
                        <td class="p-3 border border-gray-800">{{ $producto->categoria->nombre }}</td>
                        <td class="p-3 border border-gray-800">
                            <a href="{{ route('producto.edit'), $producto->id }}"
                                class="bg-sky-500 hover:bg-sky-700 text-white rounded-sm px-5 py-1 transition-all">
                                Editar</a>
                        </td>
                        <td class="p-3 border border-gray-800">
                            <form action="">
                                @csrf
                                @if ($producto->estado == 1)
                                    <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        desabilitar</button>
                                @else
                                    <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white rounded-sm px-5 py-1 transition-all cursor-pointer">
                                        habilitar</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection