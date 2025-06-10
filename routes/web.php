<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RolMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', RolMiddleware::class . ':administrador'])->group(function () {
    //rutas con verificacion de roles empezando por admin home
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

    //todas las rutas de membresia

    Route::get('/admin/membresia', [App\Http\Controllers\AdminController::class, 'membresia'])->name('admin.membresia');
    Route::get('/admin/membresia/agregar', [App\Http\Controllers\AdminController::class, 'agregarMembresia'])->name('admin.membresia.agregar');
    Route::get('/admin/membresia/eliminar', [App\Http\Controllers\AdminController::class, 'eliminarMembresia'])->name('admin.membresia.eliminar');
    Route::get('/admin/membresia/modificar', [App\Http\Controllers\AdminController::class, 'modificarMembresia'])->name('admin.membresia.modificar');
    Route::get('/admin/membresia/consultar', [App\Http\Controllers\AdminController::class, 'consultarMembresia'])->name('admin.membresia.consultar');
    

    //-------------------metodos post de membresia ---------------------------
    Route::post('/admin/membresia/guardar', [App\Http\Controllers\MembresiaController::class, 'guardar'])->name('membresia.guardar');
    Route::post('/admin/membresia/eliminar', [App\Http\Controllers\MembresiaController::class, 'eliminar'])->name('membresia.eliminar');
    Route::post('/admin/membresia/modificar', [App\Http\Controllers\MembresiaController::class, 'modificar'])->name('membresia.modificar');
    Route::post('/admin/membresia/consultar', [App\Http\Controllers\MembresiaController::class, 'consultar'])->name('membresia.consultar');




    //todas las rutas de suplementos

    Route::get('/admin/suplementos', [App\Http\Controllers\AdminController::class, 'suplementos'])->name('admin.suplementos');
    Route::get('/admin/suplementos/agregar', [App\Http\Controllers\AdminController::class, 'agregarSuplemento'])->name('admin.suplementos.agregar');
    Route::get('/admin/suplementos/eliminar', [App\Http\Controllers\AdminController::class, 'eliminarSuplemento'])->name('admin.suplementos.eliminar');
    Route::get('/admin/suplementos/modificar', [App\Http\Controllers\AdminController::class, 'modificarSuplemento'])->name('admin.suplementos.modificar');
    Route::get('/admin/suplementos/consultar', [App\Http\Controllers\AdminController::class, 'consultarSuplemento'])->name('admin.suplementos.consultar');

    //todas las rutas de spinning

    Route::get('/admin/spinning', [App\Http\Controllers\AdminController::class, 'spinning'])->name('admin.spinning');
    Route::get('/admin/spinning/agregar', [App\Http\Controllers\AdminController::class, 'agregarClase'])->name('admin.spinning.agregar');
    Route::get('/admin/spinning/eliminar', [App\Http\Controllers\AdminController::class, 'eliminarClase'])->name('admin.spinning.eliminar');
    Route::get('/admin/spinning/modificar', [App\Http\Controllers\AdminController::class, 'modificarClase'])->name('admin.spinning.modificar');
    Route::get('/admin/spinning/consultar', [App\Http\Controllers\AdminController::class, 'consultarClase'])->name('admin.spinning.consultar');

    //-------------------metodos post de spinning ---------------------------
    Route::post('/admin/spinning/guardar', [App\Http\Controllers\spinningController::class, 'guardar'])->name('spinning.guardar');






    //configuracion y primera rama derivada


    Route::get('/admin/configuracion', [App\Http\Controllers\AdminController::class, 'configuracion'])->name('admin.configuracion');

    //configuracion permisos
    Route::get('/admin/configuracion/permisos', [App\Http\Controllers\AdminController::class, 'permisos'])->name('admin.configuracion.permisos');
    Route::get('/admin/configuracion/permisos/darPermiso', [App\Http\Controllers\AdminController::class, 'darPermiso'])->name('admin.configuracion.darPermiso');
    Route::get('/admin/configuracion/permisos/quitarPermiso', [App\Http\Controllers\AdminController::class, 'quitarPermiso'])->name('admin.configuracion.quitarPermiso');
    Route::get('/admin/configuracion/permisos/consultarPermiso', [App\Http\Controllers\AdminController::class, 'consultarPermiso'])->name('admin.configuracion.consultarPermiso');



    //configuracion categoria de producto
    Route::get('/admin/configuracion/categoriaProducto', [App\Http\Controllers\AdminController::class, 'categoriaProducto'])->name('admin.configuracion.categoriaProducto');
    Route::get('/admin/configuracion/categoriaProducto/agregarCategoria', [App\Http\Controllers\AdminController::class, 'agregarCategoria'])->name('admin.configuracion.agregarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/eliminarCategoria',[App\Http\Controllers\AdminController::class, 'eliminarCategoria'])->name('admin.configuracion.eliminarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/mofificarCategoria', [App\Http\Controllers\AdminController::class, 'modificarCategoria'])->name('admin.configuracion.modificarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/consultarCategoria', [App\Http\Controllers\AdminController::class, 'consultarCategoria'])->name('admin.configuracion.consultarCategoria');

    //configuracion formas de pago
    Route::get('/admin/configuracion/formaPago', [App\Http\Controllers\AdminController::class, 'formaPago'])->name('admin.configuracion.formaPago');
    Route::get('/admin/configuracion/formaPago/agregarFormaPago', [App\Http\Controllers\AdminController::class, 'agregarformaPago'])->name('admin.configuracion.agregarFormaPago');
    Route::get('/admin/configuracion/formaPago/eliminarFormaPago', [App\Http\Controllers\AdminController::class, 'eliminarformaPago'])->name('admin.configuracion.eliminarFormaPago');
    Route::get('/admin/configuracion/formaPago/modificarFormaPago', [App\Http\Controllers\AdminController::class, 'modificarformaPago'])->name('admin.configuracion.modificarFormaPago');
    Route::get('/admin/configuracion/formaPago/consultarFormaPago', [App\Http\Controllers\AdminController::class, 'consultarformaPago'])->name('admin.configuracion.consultarFormaPago');

    //configuracion inventario
    Route::get('/admin/configuracion/inventario', [App\Http\Controllers\AdminController::class, 'inventario'])->name('admin.configuracion.inventario');
    Route::get('/admin/configuracion/inventario/ingresarCantidad', [App\Http\Controllers\AdminController::class, 'ingresarCantidad'])->name('admin.configuracion.ingresarCantidad');
    Route::get('/admin/configuracion/inventario/registroVentas', [App\Http\Controllers\AdminController::class, 'registroVentas'])->name('admin.configuracion.registroVentas');
    Route::get('/admin/configuracion/inventario/consultarStock', [App\Http\Controllers\AdminController::class, 'consultarStock'])->name('admin.configuracion.consultarStock');

    //configuracion tipo de documento
    Route::get('/admin/configuracion/tipoDocumento', [App\Http\Controllers\AdminController::class, 'tipoDocumento'])->name('admin.configuracion.tipoDocumento');
    Route::get('/admin/configuracion/tipoDocumento/agregarTipo', [App\Http\Controllers\AdminController::class, 'agregarTipo'])->name('admin.configuracion.agregarTipo');
    Route::get('/admin/configuracion/tipoDocumento/eliminarTipo', [App\Http\Controllers\AdminController::class, 'eliminarTipo'])->name('admin.configuracion.eliminarTipo');
    Route::get('/admin/configuracion/tipoDocumento/modificarTipo', [App\Http\Controllers\AdminController::class, 'modificarTipo'])->name('admin.configuracion.modificarTipo');
    Route::get('/admin/configuracion/tipoDocumento/consultarTipo', [App\Http\Controllers\AdminController::class, 'consultarTipo'])->name('admin.configuracion.consultarTipo');

    //configuracion proveedor
    Route::get('/admin/configuracion/proveedor', [App\Http\Controllers\AdminController::class, 'proveedor'])->name('admin.configuracion.proveedor');
    Route::get('/admin/configuracion/proveedor/agregarProveedor', [App\Http\Controllers\AdminController::class, 'agregarProveedor'])->name('admin.configuracion.agregarProveedor');
    Route::get('/admin/configuracion/proveedor/eliminarProveedor', [App\Http\Controllers\AdminController::class, 'eliminarProveedor'])->name('admin.configuracion.eliminarProveedor');
    Route::get('/admin/configuracion/proveedor/modificarProveedor', [App\Http\Controllers\AdminController::class, 'modificarProveedor'])->name('admin.configuracion.modificarProveedor');
    Route::get('/admin/configuracion/proveedor/consultarProveedor', [App\Http\Controllers\AdminController::class, 'consultarProveedor'])->name('admin.configuracion.consultarProveedor');
});

require __DIR__.'/auth.php';
