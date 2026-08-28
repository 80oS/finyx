<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/categoria', CategoriaController::class);
Route::resource('/proveedores', ProveedorController::class);
Route::resource('/cliente', ClienteController::class);
