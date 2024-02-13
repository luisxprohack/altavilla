<?php
    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manuales\TipomoduloController;
use App\Http\Controllers\Manuales\ManualController;

//TIPO MODULO
Route::get('tipomodulo', [TipomoduloController::class, 'dataIndex'])->name('tipomodulo')->middleware('permission:manuales.tipomodulo');
Route::get('tipomodulo/list', [TipomoduloController::class, 'index'])->name('tipomodulo.list')->middleware('permission:manuales.tipomodulo');
Route::get('tipomodulo/create', [TipomoduloController::class, 'create'])->name('tipomodulo.create')->middleware('permission:manuales.tipomodulo');
Route::post('tipomodulo/store', [TipomoduloController::class, 'store'])->name('tipomodulo.store')->middleware('permission:manuales.tipomodulo');
Route::get('tipomodulo/{id}/edit', [TipomoduloController::class, 'edit'])->name('tipomodulo.edit')->middleware('permission:manuales.tipomodulo');
Route::post('tipomodulo/{id}/update', [TipomoduloController::class, 'update'])->name('tipomodulo.update')->middleware('permission:manuales.tipomodulo');
Route::get('tipomodulo/{id}/delete', [TipomoduloController::class, 'delete'])->name('tipomodulo.delete')->middleware('permission:manuales.tipomodulo');

//MANUAL

Route::get('manual', [ManualController::class, 'index'])->name('manual')->middleware('permission:manuales.manual');
Route::get('manual/create', [ManualController::class, 'create'])->name('manual.create')->middleware('permission:manuales.manual');
Route::post('manual/store', [ManualController::class, 'store'])->name('manual.store')->middleware('permission:manuales.manual');
Route::get('manual/{id}/edit', [ManualController::class, 'edit'])->name('manual.edit')->middleware('permission:manuales.manual');
Route::post('manual/{id}/update', [ManualController::class, 'update'])->name('manual.update')->middleware('permission:manuales.manual');
Route::get('manual/status/{id}/{value}', [ ManualController::class, 'status' ])->name('manual.status')->middleware('permission:manuales.manual');

Route::get('manual/home', [ManualController::class, 'home'])->name('manual.home');

Route::get('manuales/{filename}', [ManualController::class, 'show'])->name('manual.show');

