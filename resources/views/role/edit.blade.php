@extends('layouts.app')

@section('titulo', 'Asignar Permisos')

@section('content')
    <div class="flex items-center justify-center pt-10">
        <div class="w-full max-w-xl bg-blanco-calido border border-blanco-calido rounded-2xl shadow-lg shadow-gris-calido-claro p-8">
            <div class="flex flex-row items-center justify-center gap-3 mb-5 border-b border-gris-suave/50 pb-3">
                <div>
                    <i><x-lucide-pen-line class="w-8 h-8 text-verde-suave"/></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold tracking-tight text-gris-calido-oscuro text-center capitalize">
                        Asignar permisos al rol "{{ $rol->name }}"
                    </h2>
                </div>
            </div>
            <form action="{{ route('role.permiso', $rol->id) }}" method="POST">
                @csrf

                <div class="my-5">
                    <label for="" class="block text-sm font-medium text-gris-calido-oscuro mb-1.5">
                        Permisos
                    </label>
                    <div class="overflow-y-scroll max-h-50 border border-gris-suave/50 p-3">
                        <div class="flex flex-col gap-5">
                        
                            @forelse ($permisos as $modulo => $permisosModulo)
                        
                            <div class="rounded-xl border border-linea-input overflow-hidden">
                        
                                <div class="flex items-center justify-between bg-lino-natural px-4 py-3">
                                    <h4 class="text-sm font-bold text-gris-calido-oscuro">
                                        {{ $modulo }}
                                    </h4>
                        
                                    <span class="rounded-full bg-verde-salvia/10 px-2.5 py-1
                                                    text-xs font-semibold text-verde-salvia">
                                        {{ $permisosModulo->count() }}
                                    </span>
                                </div>
                        
                                <div class="flex flex-col gap-3 bg-blanco-calido p-4">
                                    @foreach ($permisosModulo as $permiso)
                                    <label class="flex items-center gap-3 cursor-pointer
                                                        rounded-lg px-2 py-1.5 hover:bg-lino-natural/60">
                        
                                        <input type="checkbox" name="permisos[]" value="{{ $permiso->name }}"
                                            class="h-5 w-5 accent-verde-salvia-claro rounded">
                        
                                        <span class="text-sm text-gris-calido-oscuro">
                                            {{ $permiso->name }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                        
                            </div>
                        
                            @empty
                            <p class="text-sm text-gris-calido-oscuro">
                                Ya tiene todos los permisos asignados.
                            </p>
                            @endforelse
                        
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gris-suave/50">
                    <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido rounded-lg cursor-pointer transition-all px-2 py-2">
                        Asignar
                    </button>
                    <a href="{{ route('rol.index') }}" class="bg-gris-calido-claro hover:bg-gris-calido-oscuro text-blanco-calido rounded-lg transition-all px-2 py-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection