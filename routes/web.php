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

    //todas las rutas de suplementos

    Route::get('/admin/suplementos', [App\Http\Controllers\AdminController::class, 'suplementos'])->name('admin.suplementos');
    Route::get('/admin/suplementos/agregar', [App\Http\Controllers\AdminController::class, 'agregarSuplemento'])->name('admin.suplementos.agregar');
    Route::get('/admin/suplementos/eliminar', [App\Http\Controllers\AdminController::class, 'eliminarSuplemento'])->name('admin.suplementos.eliminar');
    Route::get('/admin/suplementos/modificar', [App\Http\Controllers\AdminController::class, 'modificarSuplemento'])->name('admin.suplementos.modificar');
    Route::get('/admin/suplementos/consultar', [App\Http\Controllers\AdminController::class, 'consultarSuplemento'])->name('admin.suplementos.consultar');



    Route::get('/admin/spinning', [App\Http\Controllers\AdminController::class, 'spinning'])->name('admin.spinning');
    Route::get('/admin/configuracion', [App\Http\Controllers\AdminController::class, 'configuracion'])->name('admin.configuracion');
});

require __DIR__.'/auth.php';
