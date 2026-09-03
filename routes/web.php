<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/categoria', CategoriaController::class);
Route::post('/categoriaChangeState/{id}', [CategoriaController::class, 'changeState'])->name('categoria.changeState');

Route::resource('/proveedores', ProveedorController::class);

Route::resource('/producto', ProductoController::class);

Route::resource('/cliente', ClienteController::class);
Route::post('/productoChangeState/{id}', [ProductoController::class, 'changeState'])->name('producto.changeState');

Route::resource('/venta', VentasController::class);