<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RolMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Si ya está logueado...
    if (Auth::check()) {
        // si es admin, al home de admin
        if (Auth::user()->rol->idRol === 2) {
            return redirect()->route('admin.home');
        }

        if (Auth::user()->rol->idRol === 1) {
            return redirect()->route('cliente.home');
        }
        
    }
    // si no está logueado, muestra la welcome
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('cliente.home');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', RolMiddleware::class . ':cliente'])-> group(function(){

    Route::get('/cliente/perfil', [App\Http\Controllers\ClienteController::class, 'perfil'])->name('cliente.perfil');
    Route::get('/cliente/perfil/edit',[App\Http\Controllers\ClienteController::class, 'editPerfil'])->name('cliente.perfil.edit');
    Route::put('/cliente/perfil', [App\Http\Controllers\ClienteController::class, 'updatePerfil'])->name('cliente.perfil.update');

    Route::get('/cliente/home', [App\Http\Controllers\ClienteController::class, 'home'])->name('cliente.home'); 
    Route::get('/cliente/membresias', [App\Http\Controllers\ClienteController::class, 'membresias'])->name('cliente.membresias');
    Route::post('/cliente/carrito/membresia',[App\Http\Controllers\ClienteController::class, 'addMembresia'])->name('cliente.carrito.addMembresia');

    Route::get('/cliente/suplementos', [App\Http\Controllers\ClienteController::class, 'suplementos'])->name('cliente.suplementos');
    Route::post('/cliente/carrito/suplementos', [App\Http\Controllers\ClienteController::class, 'addSuplemento'])->name('cliente.carrito.addSuplemento');


    Route::get('/cliente/carrito', [App\Http\Controllers\ClienteController::class, 'verCarrito'])->name('cliente.carrito');
    
    Route::post('/cliente/carrito/{key}/increment',[App\Http\Controllers\ClienteController::class,'incrementItem'])->name('cliente.carrito.increment');
    Route::post('/cliente/carrito/{key}/decrement',[App\Http\Controllers\ClienteController::class,'decrementItem'])->name('cliente.carrito.decrement');
    Route::delete ('/cliente/carrito',[App\Http\Controllers\ClienteController::class,'clearCart'   ])->name('cliente.carrito.clear');
    
    Route::post('/cliente/carrito/checkout',[App\Http\Controllers\ClienteController::class,'checkout'])->name('cliente.carrito.checkout');
    Route::delete('/cliente/carrito/{key}', [App\Http\Controllers\ClienteController::class,'removeItem'])->name('cliente.carrito.remove');
    Route::get('/cliente/facturas',[App\Http\Controllers\ClienteController::class,'verFacturas'])->name('cliente.facturas');



    Route::get('/cliente/spinning',[App\Http\Controllers\ClienteController::class,'spinning'])->name('cliente.spinning');
    Route::post('/cliente/spinning/reservar', [App\Http\Controllers\ClienteController::class,'reservarSpinning'])->name('cliente.spinning.reservar');


});



Route::middleware(['auth', RolMiddleware::class . ':administrador'])->group(function () {
    //rutas con verificacion de roles empezando por admin home
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'home'])->name('admin.home');

    Route::get('/admin/perfil', [App\Http\Controllers\AdminController::class, 'perfil'])->name('admin.perfil');
    Route::get('/admin/perfil/edit',[App\Http\Controllers\AdminController::class, 'editPerfil'])->name('admin.perfil.edit');
    Route::put('/admin/perfil', [App\Http\Controllers\AdminController::class, 'updatePerfil'])->name('admin.perfil.update');


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
    Route::get('/admin/suplementos/consultar', [App\Http\Controllers\InventarioController::class,'consultarStock'])->name('admin.suplementos.consultar');
    //-------------------metodos post de suplementos ---------------------------
    Route::post('/admin/suplementos/guardar', [App\Http\Controllers\SuplementoController::class, 'guardar'])->name('suplementos.guardar');
    Route::post('/admin/suplementos/modificar', [App\Http\Controllers\SuplementoController::class, 'modificar'])->name('suplementos.modificar');
    Route::post('/admin/suplementos/eliminar', [App\Http\Controllers\SuplementoController::class, 'eliminar'])->name('suplementos.eliminar');
    




    //todas las rutas de spinning

    Route::get('/admin/spinning', [App\Http\Controllers\AdminController::class, 'spinning'])->name('admin.spinning');
    Route::get('/admin/spinning/agregar', [App\Http\Controllers\AdminController::class, 'agregarClase'])->name('admin.spinning.agregar');
    Route::get('/admin/spinning/eliminar', [App\Http\Controllers\AdminController::class, 'eliminarClase'])->name('admin.spinning.eliminar');
    Route::get('/admin/spinning/modificar', [App\Http\Controllers\AdminController::class, 'modificarClase'])->name('admin.spinning.modificar');
    Route::get('/admin/spinning/consultar', [App\Http\Controllers\AdminController::class, 'consultarClase'])->name('admin.spinning.consultar');

    //-------------------metodos post de spinning ---------------------------
    Route::post('/admin/spinning/guardar', [App\Http\Controllers\spinningController::class, 'guardar'])->name('spinning.guardar');
    Route::post('/admin/spinning/eliminar', [App\Http\Controllers\spinningController::class, 'eliminar'])->name('spinning.eliminar');
    Route::post('/admin/spinning/modificar', [App\Http\Controllers\spinningController::class, 'modificar'])->name('spinning.modificar');
    Route::post('/admin/spinning/consultar', [App\Http\Controllers\spinningController::class, 'consultar'])->name('spinning.consultar');





    //configuracion y primera rama derivada


    Route::get('/admin/configuracion', [App\Http\Controllers\AdminController::class, 'configuracion'])->name('admin.configuracion');

    //configuracion permisos
    Route::get('/admin/configuracion/permisos', [App\Http\Controllers\AdminController::class, 'permisos'])->name('admin.configuracion.permisos');
    Route::get('/admin/configuracion/permisos/darPermiso', [App\Http\Controllers\AdminController::class, 'darPermiso'])->name('admin.configuracion.darPermiso');
    Route::get('/admin/configuracion/permisos/quitarPermiso', [App\Http\Controllers\AdminController::class, 'quitarPermiso'])->name('admin.configuracion.quitarPermiso');
    Route::get('/admin/configuracion/permisos/consultarPermiso', [App\Http\Controllers\AdminController::class, 'consultarPermiso'])->name('admin.configuracion.consultarPermiso');
    
    //-------------------metodos post de categaria de producto ---------------------------
    Route::post('/admin/configuracion/permisos/dar',[App\Http\Controllers\PermisosController::class, 'darPermiso']) -> name('permisos.dar');
    Route::post('/admin/configuracion/permisos/quitar',[App\Http\Controllers\PermisosController::class, 'quitarPermiso']) -> name('permisos.quitar');
    Route::post('/admin/configuracion/permisos/consultar',[App\Http\Controllers\PermisosController::class, 'consultarPermiso']) -> name('permisos.consultar');


    //configuracion categoria de producto
    Route::get('/admin/configuracion/categoriaProducto', [App\Http\Controllers\AdminController::class, 'categoriaProducto'])->name('admin.configuracion.categoriaProducto');
    Route::get('/admin/configuracion/categoriaProducto/agregarCategoria', [App\Http\Controllers\AdminController::class, 'agregarCategoria'])->name('admin.configuracion.agregarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/eliminarCategoria',[App\Http\Controllers\AdminController::class, 'eliminarCategoria'])->name('admin.configuracion.eliminarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/mofificarCategoria', [App\Http\Controllers\AdminController::class, 'modificarCategoria'])->name('admin.configuracion.modificarCategoria');
    Route::get('/admin/configuracion/categoriaProducto/consultarCategoria', [App\Http\Controllers\AdminController::class, 'consultarCategoria'])->name('admin.configuracion.consultarCategoria');

    //-------------------metodos post de categaria de producto ---------------------------
    Route::post('admin/configuracion/categoriaProducto/guardar',[App\Http\Controllers\CategoriaController::class, 'guardar'])->name('categoria.guardar');
    Route::post('admin/configuracion/categoriaProducto/eliminar',[App\Http\Controllers\CategoriaController::class, 'eliminar'])->name('categoria.eliminar');
    Route::post('admin/configuracion/categoriaProducto/modificar',[App\Http\Controllers\CategoriaController::class, 'modificar'])->name('categoria.modificar');
    Route::post('admin/configuracion/categoriaProducto/consultar',[App\Http\Controllers\CategoriaController::class, 'consultar'])->name('categoria.consultar');






    //configuracion formas de pago
    Route::get('/admin/configuracion/formaPago', [App\Http\Controllers\AdminController::class, 'formaPago'])->name('admin.configuracion.formaPago');
    Route::get('/admin/configuracion/formaPago/agregarFormaPago', [App\Http\Controllers\AdminController::class, 'agregarformaPago'])->name('admin.configuracion.agregarFormaPago');
    Route::get('/admin/configuracion/formaPago/eliminarFormaPago', [App\Http\Controllers\AdminController::class, 'eliminarformaPago'])->name('admin.configuracion.eliminarFormaPago');
    Route::get('/admin/configuracion/formaPago/modificarFormaPago', [App\Http\Controllers\AdminController::class, 'modificarformaPago'])->name('admin.configuracion.modificarFormaPago');
    Route::get('/admin/configuracion/formaPago/consultarFormaPago', [App\Http\Controllers\AdminController::class, 'consultarformaPago'])->name('admin.configuracion.consultarFormaPago');

     //-----------------------------metodos post de tipo de documento ------------------------------------
    Route::post('/admin/configuracion/formaPago/guardar',[App\Http\Controllers\FormaPagoController::class, 'guardar']) -> name('formaPago.guardar');
    Route::post('/admin/configuracion/formaPago/eliminar',[App\Http\Controllers\FormaPagoController::class, 'eliminar']) -> name('formaPago.eliminar');
    Route::post('/admin/configuracion/formaPago/modificar',[App\Http\Controllers\FormaPagoController::class, 'modificar']) -> name('formaPago.modificar');
    Route::post('/admin/configuracion/formaPago/consultar',[App\Http\Controllers\FormaPagoController::class, 'consultar']) -> name('formaPago.consultar');







    //configuracion inventario
    Route::get('/admin/configuracion/inventario', [App\Http\Controllers\AdminController::class, 'inventario'])->name('admin.configuracion.inventario');
    Route::get('/admin/configuracion/inventario/ingresar',  [App\Http\Controllers\InventarioController::class,'ingresarCantidad'])->name('admin.configuracion.inventario.ingresar');
    Route::post('/admin/configuracion/inventario/ingresar', [App\Http\Controllers\InventarioController::class,'store'])           ->name('admin.configuracion.inventario.store');
    Route::get('/admin/configuracion/inventario/ventas',    [App\Http\Controllers\InventarioController::class,'registroVentas']) ->name('admin.configuracion.inventario.ventas');
    Route::get('/admin/configuracion/inventario/stock',     [App\Http\Controllers\InventarioController::class,'consultarStock'])->name('admin.configuracion.inventario.stock');



    //configuracion tipo de documento
    Route::get('/admin/configuracion/tipoDocumento', [App\Http\Controllers\AdminController::class, 'tipoDocumento'])->name('admin.configuracion.tipoDocumento');
    Route::get('/admin/configuracion/tipoDocumento/agregarTipo', [App\Http\Controllers\AdminController::class, 'agregarTipo'])->name('admin.configuracion.agregarTipo');
    Route::get('/admin/configuracion/tipoDocumento/eliminarTipo', [App\Http\Controllers\AdminController::class, 'eliminarTipo'])->name('admin.configuracion.eliminarTipo');
    Route::get('/admin/configuracion/tipoDocumento/modificarTipo', [App\Http\Controllers\AdminController::class, 'modificarTipo'])->name('admin.configuracion.modificarTipo');
    Route::get('/admin/configuracion/tipoDocumento/consultarTipo', [App\Http\Controllers\AdminController::class, 'consultarTipo'])->name('admin.configuracion.consultarTipo');

    //-----------------------------metodos post de tipo de documento ------------------------------------
    Route::post('/admin/configuracion/tipoDocumento/guardar', [App\Http\Controllers\TipoDocumentoController::class, 'guardar']) -> name('tipoDocumento.guardar');
    Route::post('/admin/configuracion/tipoDocumento/eliminar', [App\Http\Controllers\TipoDocumentoController::class, 'eliminar']) -> name('tipoDocumento.eliminar');
    Route::post('/admin/configuracion/tipoDocumento/modificar', [App\Http\Controllers\TipoDocumentoController::class, 'modificar']) -> name('tipoDocumento.modificar');
    Route::post('/admin/configuracion/tipoDocumento/consultar', [App\Http\Controllers\TipoDocumentoController::class, 'consultar']) -> name('tipoDocumento.consultar');


    //configuracion proveedor
    Route::get('/admin/configuracion/proveedor', [App\Http\Controllers\AdminController::class, 'proveedor'])->name('admin.configuracion.proveedor');
    Route::get('/admin/configuracion/proveedor/agregarProveedor', [App\Http\Controllers\AdminController::class, 'agregarProveedor'])->name('admin.configuracion.agregarProveedor');
    Route::get('/admin/configuracion/proveedor/eliminarProveedor', [App\Http\Controllers\AdminController::class, 'eliminarProveedor'])->name('admin.configuracion.eliminarProveedor');
    Route::get('/admin/configuracion/proveedor/modificarProveedor', [App\Http\Controllers\AdminController::class, 'modificarProveedor'])->name('admin.configuracion.modificarProveedor');
    Route::get('/admin/configuracion/proveedor/consultarProveedor', [App\Http\Controllers\AdminController::class, 'consultarProveedor'])->name('admin.configuracion.consultarProveedor');
    //-------------------metodos post de proveedor---------------------------

    Route::post('/admin/configuracion/proveedor/agregar', [App\Http\Controllers\proveedorController::class, 'agregar']) -> name('proveedor.agregar');
    Route::post('/admin/configuracion/proveedor/eliminar', [App\Http\Controllers\proveedorController::class, 'eliminar']) -> name('proveedor.eliminar');
    Route::post('/admin/configuracion/proveedor/modificar', [App\Http\Controllers\proveedorController::class, 'modificar']) -> name('proveedor.modificar');
    Route::post('/admin/configuracion/proveedor/consultar', [App\Http\Controllers\proveedorController::class, 'consultar']) -> name('proveedor.consultar');

});

require __DIR__.'/auth.php';
