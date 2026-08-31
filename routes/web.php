<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/categoria', CategoriaController::class);
Route::post('/categoriaChangeState/{id}', [CategoriaController::class, 'changeState'])->name('categoria.changeState');

Route::resource('/proveedores', ProveedorController::class);

Route::resource('/producto', ProductoController::class);

Route::resource('/cliente', ClienteController::class);
