@extends('layouts.app')

@section('titulo', 'home')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fill, 20rem); gap: 1rem;">
        <livewire:alerta-stock />
        <livewire:producto-mas-vendido />
    </div>
@endsection