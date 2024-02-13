<?php

use App\Http\Controllers\ManualController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParametrizarController;
use App\Http\Controllers\TipomoduloController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InventarioController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=> 'auth'], function(){

    //MANTENIMIENTO DE TABLAS PARAMETRICAS
    Route::get('parametrizars/{table}', [ ParametrizarController::class, 'index']);
    Route::get('parametrizar/create/{table}', [ ParametrizarController::class, 'create'])->name('parametrizar.create');
    Route::post('parametrizar/store', [ ParametrizarController::class, 'store' ])->name('parametrizar.store');
    Route::get('parametrizar/edit/{id}/{table}', [ ParametrizarController::class, 'edit'])->name('parametrizar.edit');
    Route::post('parametrizar/update/{id}', [ ParametrizarController::class, 'update'])->name('parametrizar.update');
    Route::get('parametrizar/delete/{id}/{table}/{relaciones}', [ ParametrizarController::class, 'destroy'])->name('parametrizar.delete');
    
    //RUTAS DE PERSONAS
    require __DIR__ . '/personas.php';
    //RUTAS DE SEGURIDAD
    require __DIR__ . '/security.php';
   // RUTA MANUALES
   require __DIR__ . '/manuales.php'; 


   Route::get('inventario', [ InventarioController::class, 'dataIndex' ])->name('inventario');
   Route::get('inventario/list', [ InventarioController::class, 'index' ])->name('inventario.list');
   Route::get('inventario/create', [ InventarioController::class, 'create' ])->name('inventario.create');
   Route::post('inventario/store', [ InventarioController::class, 'store' ])->name('inventario.store');
   Route::get('inventario/{id}/edit', [ InventarioController::class, 'edit' ])->name('inventario.edit');
   Route::post('inventario/{id}/update', [ InventarioController::class, 'update' ])->name('inventario.update');
   Route::get('inventario/estado/{id}', [ InventarioController::class, 'estado' ])->name('inventario.estado');
   
    
    
});