<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentasController;
use App\Livewire\FacturaProduct;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('/categoria', CategoriaController::class);
Route::post('/categoriaChangeState/{id}', [CategoriaController::class, 'changeState'])->name('categoria.changeState');

Route::resource('/proveedores', ProveedorController::class);

Route::resource('/producto', ProductoController::class);

Route::resource('/cliente', ClienteController::class);

Route::resource('/compra', CompraController::class);

Route::post('/productoChangeState/{id}', [ProductoController::class, 'changeState'])->name('producto.changeState');

Route::resource('/venta', VentasController::class);

Route::get('/facturaProduct', FacturaProduct::class)->name('agregar.producto');
