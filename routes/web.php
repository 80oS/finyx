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
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
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
        ->middlewareFor(['index'], 'can:producto.ver')
        ->middlewareFor(['create', 'store'], 'can:producto.crear')
        ->middlewareFor(['edit', 'update'], 'can:producto.editar');
    Route::post('/productoChangeState/{id}', [ProductoController::class, 'changeState'])
        ->middleware('can:producto.changeState')->name('producto.changeState');

    //categoria
    Route::resource('/categoria', CategoriaController::class)->except('destroy', 'show')
        ->middlewareFor(['index'], 'can:categoria.ver')
        ->middlewareFor(['create', 'store'], 'can:categoria.crear')
        ->middlewareFor(['edit', 'uptade'], 'can:categoria.editar');

    Route::post('/categoriaChangeState/{id}', [CategoriaController::class, 'changeState'])
        ->middleware('can:categoria.changeState')
        ->name('categoria.changeState');

    Route::get('/categorias/{categoria}/productos', [CategoriaController::class, 'productos'])
        ->middleware('can:categoria.productos')
        ->name('categorias.productos');

    //proveedor
    Route::resource('/proveedores', ProveedorController::class)->except('show')
        ->middlewareFor(['index'], 'can:proveedor.ver')
        ->middlewareFor(['create', 'store'], 'can:proveedor.crear')
        ->middlewareFor(['edit', 'update'], 'can:proveedor.editar')
        ->middlewareFor(['destroy'], 'can:proveedor.eliminar');

    //Compra
    Route::resource('/compra', CompraController::class)->except('destroy')
        ->middlewareFor(['index'], 'can:compra.ver')
        ->middlewareFor(['create', 'store'], 'can:compra.crear');
    Route::get('/compras/historial', HistorialCompras::class)
        ->middleware('can:compra.historial')
        ->name('compras.historial');

    //cliente
    Route::resource('/cliente', ClienteController::class)->except('show')
        ->middlewareFor(['index'], 'can:cliente.ver')
        ->middlewareFor(['create', 'store'], 'can:cliente.crear')
        ->middlewareFor(['edit', 'update'], 'can:cliente.editar')
        ->middlewareFor(['destroy'], 'can:cliente.eliminar');

    //ubicacion
    Route::resource('/ubicacion', UbicacionController::class)->except('destroy')
        ->middlewareFor(['index'], 'can:ubicacion.ver')
        ->middlewareFor(['create', 'store'], 'can:ubicacion.crear')
        ->middlewareFor(['edit', 'update'], 'can:ubicacion.editar');

    Route::post('/ubcacionChangeState/{id}', [UbicacionController::class, 'changeState'])
        ->middleware('can:ubicacion.changeState')
        ->name('ubicacion.changeState');
    Route::put('/asignarProductosUbicacion/{id}/productos', [UbicacionController::class, 'asignarProductosUbicacion'])
        ->middleware('can:ubicacion.asignar-productos')
        ->name('ubicacion.asignarProducto');
    Route::post('/ubicacion/{id}/mover-productos', [UbicacionController::class, 'MoverProductosUbicacion'])
        ->middleware('can:ubicacion.mover-productos')
        ->name('ubicacion.moverProductos');

    //venta
    Route::resource('/venta', VentasController::class)->except('destroy')
        ->middlewareFor(['index', 'show'], 'can:facturas.ver')
        ->middlewareFor(['create', 'store'], 'can:facturas.crear');

    //impuesto
    Route::resource('/impuesto', ImpuestoController::class)->except('destroy')
        ->middlewareFor(['index'], 'can:impuesto.ver')
        ->middlewareFor(['create', 'store'], 'can:impuesto.crear')
        ->middlewareFor(['edit', 'update'], 'can:impuesto.editar')
        ->middlewareFor(['show'], 'can:impuesto.show');
    Route::post('/impuesto/changeState/{id}', [ImpuestoController::class, 'changeState'])
        ->middleware('can:impuesto.changeState')
        ->name('impuesto.changeState');
    Route::post('/impuesto/AsignarImpuestoProducto/{id}', [ImpuestoController::class, 'asignarImpuestoProducto'])
        ->middleware('can:impuesto.producto')
        ->name('impuesto.producto');
    Route::get('/impuesto/detalle/{id}', [ImpuestoController::class, 'detalleImpuesto'])
        ->middleware('can:impuesto.detalle')
        ->name('impuesto.detalle');

    //registro
    Route::get('/register', [AuthController::class, 'registroCreate'])
        ->middleware('can:registro.ver')
        ->name('registro.create');
    Route::post('/register/store', [AuthController::class, 'registroStore'])
        ->middleware('can:registro.crear')
        ->name('register');

    // User
    Route::get('/user/index', [UserController::class, 'index'])
        ->middleware('can:usuarios.ver')
        ->name('user.index');

    Route::get('/user/{id}', [UserController::class, 'edit'])
        ->middleware('can:usuarios.editar')
        ->name('user.edit');
    Route::post('user/role/{id}', [UserController::class, 'asignarRole'])
        ->middleware('can:usuarios.editar')
        ->name('user.role');
    
    Route::delete('/user/{id}/rol/{rolId}', [UserController::class, 'anularRol'])->name('user.anular');

    //roles
    Route::resource('/rol', RolController::class)->except('destroy')
        ->middlewareFor(['index'], 'can:roles.ver')
        ->middlewareFor(['create', 'store'], 'can:roles.crear')
        ->middlewareFor(['edit'], 'can:roles.editar');

    Route::post('/rol/permiso/{id}', [RolController::class, 'asignarPermisos'])
        ->middleware('can:roles.asignar-permisos')
        ->name('role.permiso');
    
    Route::delete('/rol/anular/permisos/{id}', [RolController::class, 'anularPermisos'])
        ->name('role.anular.permisos');
});
