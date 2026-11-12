<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\ImpuestoController;
use App\Livewire\FacturaProduct;
use App\Livewire\HistorialCompras;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Route;

// ======================================================
// RUTAS PUBLICAS
// ======================================================

Route::get('/', function(){
    return view('user.login');})->name('login');


// usuario
Route::post('/login/store', [AuthController::class, 'store'])->name('login.store');


// ======================================================
// RUTAS PROTEGIDAS
// ======================================================

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

    // productos
    Route::resource('/producto', ProductoController::class)->except(['destroy', 'show'])
        ->middlewareFor(['index'], 'permission:producto.ver')
        ->middlewareFor(['create', 'store'], 'permission:producto.crear')
        ->middlewareFor(['edit', 'update'], 'permission:producto.editar');
    Route::post('/productoChangeState/{id}', [ProductoController::class, 'changeState'])
        ->middleware('permission:producto.changeState')->name('producto.changeState');

    //categoria
    Route::resource('/categoria', CategoriaController::class)->except('destroy', 'show')
        ->middlewareFor(['index'], 'permission:categoria.ver')
        ->middlewareFor(['create', 'store'], 'permission:categoria.crear')
        ->middlewareFor(['edit', 'uptade'], 'permission:categoria.editar');

    Route::post('/categoriaChangeState/{id}', [CategoriaController::class, 'changeState'])
        ->middleware('permission:categoria.changeState')
        ->name('categoria.changeState');

    Route::get('/categorias/{categoria}/productos', [CategoriaController::class, 'productos'])
        ->middleware('permission:categoria.productos')
        ->name('categorias.productos');

    //proveedor
    Route::resource('/proveedores', ProveedorController::class)->except('show', 'destroy')
        ->middlewareFor(['index'], 'permission:proveedor.ver')
        ->middlewareFor(['create', 'store'], 'permission:proveedor.crear')
        ->middlewareFor(['edit', 'update'], 'permission:proveedor.editar');

    //Compra
    Route::resource('/compra', CompraController::class);
    Route::get('/compras/historial', HistorialCompras::class)->name('compras.historial');

    //cliente
    Route::resource('/cliente', ClienteController::class);

    //ubicacion
    Route::resource('/ubicacion', UbicacionController::class);
    Route::post('/ubcacionChangeState/{id}', [UbicacionController::class, 'changeState'])->name('ubicacion.changeState');
    Route::put('/asignarProductosUbicacion/{id}/productos', [UbicacionController::class, 'asignarProductosUbicacion'])->name('ubicacion.asignarProducto');
    Route::post('/ubicacion/{id}/mover-productos', [UbicacionController::class, 'MoverProductosUbicacion'])->name('ubicacion.moverProductos');

    //venta
    Route::resource('/venta', VentasController::class);

    //impuesto
    Route::resource('/impuesto', ImpuestoController::class);
    Route::post('/impuesto/changeState/{id}', [ImpuestoController::class, 'changeState'])->name('impuesto.changeState');
    Route::post('/impuesto/AsignarImpuestoProducto/{id}', [ImpuestoController::class, 'asignarImpuestoProducto'])->name('impuesto.producto');
    Route::get('/impuesto/detalle/{id}', [ImpuestoController::class, 'detalleImpuesto'])->name('impuesto.detalle');

    //registro
    Route::get('/register', [AuthController::class, 'registroCreate'])->name('registro.create');
    Route::post('/register/store', [AuthController::class, 'registroStore'])->name('register');

    // Módulo de roles
    Route::prefix('roles')
        ->name('roles.')
        ->middleware('permission:roles.ver')
        ->group(function () {

            Route::get('/', [RolController::class, 'index'])
                ->name('index');

            Route::post('/', [RolController::class, 'store'])
                ->middleware('permission:roles.crear')
                ->name('store');

            Route::put('/{rol}', [RolController::class, 'update'])
                ->middleware('permission:roles.editar')
                ->name('update');

            Route::delete('/{rol}', [RolController::class, 'destroy'])
                ->middleware('permission:roles.eliminar')
                ->name('destroy');

            Route::put('/{rol}/permisos', [
                RolController::class,
                'asignarPermisos'
            ])
                ->middleware('permission:roles.asignar-permisos')
                ->name('asignar-permisos');
        });
});