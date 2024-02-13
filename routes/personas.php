<?php

    use App\Http\Controllers\PersonaController;
    use App\Http\Controllers\TipodocumentoController;
    use Illuminate\Support\Facades\Route;

    Route::get('personas/search/{tipo}', [PersonaController::class, 'search'])->name('personas.search');
    
    Route::get('personas', [ PersonaController::class, 'dataIndex' ])->name('personas')->middleware('permission:personas.listado');
    Route::get('personas/list', [ PersonaController::class, 'index' ])->name('personas.list')->middleware('permission:personas.listado');
    Route::get('personas/show', [ PersonaController::class, 'show' ])->name('personas.show');
    Route::get('personas/create', [ PersonaController::class, 'create' ])->name('personas.create')->middleware('permission:personas.listado.registrar');
    Route::post('personas/store', [ PersonaController::class, 'store' ])->name('personas.store')->middleware('permission:personas.listado.registrar');
    Route::get('personas/{id}/edit', [ PersonaController::class, 'edit' ])->name('personas.edit')->middleware('permission:personas.listado.modificar');
    Route::post('personas/{id}/update', [ PersonaController::class, 'update' ])->name('personas.update')->middleware('permission:personas.listado.modificar');
    Route::get('personas/active/{id}/{value}', [ PersonaController::class, 'active' ])->name('personas.active')->middleware('permission:personas.listado.eliminar');

    Route::get('direccion/list/{persona}',[ PersonaController::class, 'direccionList' ])->name('personas.direccion.listar');
    Route::get('direccion/create', [ PersonaController::class, 'direccionCreate' ])->name('personas.direccion.create');
    Route::post('direccion/store', [ PersonaController::class, 'direccionStore' ])->name('personas.direccion.store');
    Route::get('direccion/{id}/edit', [ PersonaController::class, 'direccionEdit' ])->name('personas.direccion.edit');
    Route::post('direccion/{id}/update', [ PersonaController::class, 'direccionUpdate' ])->name('personas.direccion.update');
    Route::get('direccion/delete/{id}',[ PersonaController::class, 'direccionDelete' ])->name('personas.direccion.delete');
    
    Route::get('tipodocumentos', [ TipodocumentoController::class, 'index'])->name('tipodocumentos')->middleware('permission:personas.tipo_documentos');
    Route::get('tipodocumento/create', [ TipodocumentoController::class, 'create'])->name('tipodocumento.create');
    Route::post('tipodocumento/store', [ TipodocumentoController::class, 'store' ])->name('tipodocumento.store');
    Route::get('tipodocumento/edit/{id}', [ TipodocumentoController::class, 'edit'])->name('tipodocumento.edit');
    Route::post('tipodocumento/update/{id}', [ TipodocumentoController::class, 'update'])->name('tipodocumento.update')->middleware('permission:personas.tipodocumento');
    Route::get('tipodocumento/delete/{id}', [ TipodocumentoController::class, 'destroy'])->name('tipodocumento.delete')->middleware('permission:personas.tipodocumento');
    Route::get('getTipoDocumentos/{tipoPersona}', [ TipodocumentoController::class, 'getTipoDocumentos']);

    //UBIGEOS
    Route::get('ubigeo/{ubigeo}', [ PersonaController::class, 'getSelectedUbigeo' ]);
    // FIN UBIGEOS

    //CONSULTA DNI
    Route::get('persona_dni/{dni}', [PersonaController::class, 'consultaDNI']);
?>
