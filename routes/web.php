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
    Route::resource('/compra', CompraController::class)->except('destroy')
        ->middlewareFor(['index'], 'permission:compra.ver')
        ->middlewareFor(['create', 'store'], 'permission:compra.crear');
    Route::get('/compras/historial', HistorialCompras::class)
        ->middleware('permission:compra.historial')
        ->name('compras.historial');

    //cliente
    Route::resource('/cliente', ClienteController::class)->except('show')
        ->middlewareFor(['index'], 'permission:cliente.ver')
        ->middlewareFor(['create', 'store'], 'permission:cliente.crear')
        ->middlewareFor(['edit', 'update'], 'permission:cliente.editar')
        ->middlewareFor(['destroy'], 'permission:cliente.eliminar');

    //ubicacion
    Route::resource('/ubicacion', UbicacionController::class)->except('destroy')
        ->middlewareFor(['index'], 'permission:ubicacion.ver')
        ->middlewareFor(['create', 'store'], 'permission:ubicacion.crear')
        ->middlewareFor(['edit', 'update'], 'permission:ubicacion.editar');

    Route::post('/ubcacionChangeState/{id}', [UbicacionController::class, 'changeState'])
        ->middleware('permission:ubicacion.changeState')
        ->name('ubicacion.changeState');
    Route::put('/asignarProductosUbicacion/{id}/productos', [UbicacionController::class, 'asignarProductosUbicacion'])
        ->middleware('permission:ubicacion.asignar-productos')
        ->name('ubicacion.asignarProducto');
    Route::post('/ubicacion/{id}/mover-productos', [UbicacionController::class, 'MoverProductosUbicacion'])
        ->middleware('permission:ubicacion.mover-productos')
        ->name('ubicacion.moverProductos');

    //venta
    Route::resource('/venta', VentasController::class)->except('destroy')
        ->middlewareFor(['index', 'show'], 'permission:facturas.ver')
        ->middlewareFor(['create', 'store'], 'permission:facturas.crear');

    //impuesto
    Route::resource('/impuesto', ImpuestoController::class)->except('destroy')
        ->middlewareFor(['index'], 'permission:impuesto.ver')
        ->middlewareFor(['create', 'store'], 'permission:impuesto.crear')
        ->middlewareFor(['edit', 'update'], 'permission:impuesto.editar')
        ->middlewareFor(['show'], 'permission:impuesto.show');
    Route::post('/impuesto/changeState/{id}', [ImpuestoController::class, 'changeState'])
        ->middleware('permission:impuesto.changeState')
        ->name('impuesto.changeState');
    Route::post('/impuesto/AsignarImpuestoProducto/{id}', [ImpuestoController::class, 'asignarImpuestoProducto'])
        ->middleware('permission:impuesto.producto')
        ->name('impuesto.producto');
    Route::get('/impuesto/detalle/{id}', [ImpuestoController::class, 'detalleImpuesto'])
        ->middleware('permission:impuesto.detalle')
        ->name('impuesto.detalle');

    //registro
    Route::get('/register', [AuthController::class, 'registroCreate'])
        ->middleware('permission:registro.ver')
        ->name('registro.create');
    Route::post('/register/store', [AuthController::class, 'registroStore'])
        ->middleware('permission:registro.crear')
        ->name('register');

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
