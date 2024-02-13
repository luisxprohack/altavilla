<?php

use App\Http\Controllers\AgenciaController;
use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Security\CargoController;
    use App\Http\Controllers\Security\UserController;
    use App\Http\Controllers\Security\RoleController;
    use App\Http\Controllers\Security\PermissionController;
    use App\Http\Controllers\SucursalController;

    Route::get('cargos', [ CargoController::class, 'dataIndex' ])->name('cargos')->middleware('permission:seguridad.usuarios.cargos');
    Route::get('cargos/list', [ CargoController::class, 'index' ])->name('cargos.list')->middleware('permission:seguridad.usuarios.cargos');
    Route::get('cargos/create', [ CargoController::class, 'create' ])->name('cargos.create')->middleware('permission:seguridad.usuarios.cargos');
    Route::post('cargos/store', [ CargoController::class, 'store' ])->name('cargos.store')->middleware('permission:seguridad.usuarios.cargos');
    Route::get('cargos/{id}/edit', [ CargoController::class, 'edit' ])->name('cargos.edit')->middleware('permission:seguridad.usuarios.cargos');
    Route::post('cargos/{id}/update', [ CargoController::class, 'update' ])->name('cargos.update')->middleware('permission:seguridad.usuarios.cargos');
    Route::get('cargos/delete/{id}', [ CargoController::class, 'delete' ])->name('cargos.delete')->middleware('permission:seguridad.usuarios.cargos');
    //CARGA DATOS EN EL COMBO cbCargos
    Route::get('cargos/cb/{area}', [ CargoController::class, 'getCargo' ]);

    Route::match(array('GET','POST'),'users/search', [UserController::class, 'search' ])->name('search_user');

    Route::get('users', [UserController::class, 'viewIndex' ])->name('users')->middleware('permission:seguridad.usuarios.listado');
    Route::get('users/list', [UserController::class, 'index' ])->name('users.list')->middleware('permission:seguridad.usuarios.listado');
    Route::get('users/show/{id}', [UserController::class, 'show' ])->name('users.show');
    Route::get('users/create', [UserController::class, 'create' ])->name('users.create')->middleware('permission:seguridad.usuarios.listado.registrar');
    Route::post('users/store', [UserController::class, 'store' ])->name('users.store')->middleware('permission:seguridad.usuarios.listado.registrar');
    Route::get('users/{id}/edit', [UserController::class, 'edit' ])->name('users.edit')->middleware('permission:seguridad.usuarios.listado.modificar');
    Route::post('users/{id}/update', [UserController::class, 'update' ])->name('users.update')->middleware('permission:seguridad.usuarios.listado.modificar');
    Route::get('users/{user}/active/{estado}', [UserController::class, 'active' ])->name('users.active')->middleware('permission:seguridad.usuarios.listado.deshabilitar');
    // user-roles
    Route::get('users/roles', [UserController::class, 'viewRoles' ])->name('users.roles')->middleware('permission:seguridad.usuarios.asignar_perfil');
    Route::get('users/roles/list', [UserController::class, 'roles' ])->name('users.roles.list')->middleware('permission:seguridad.usuarios.asignar_perfil');
    Route::match(array('GET', 'POST'),'users/roles/asignar/{id}', [UserController::class, 'rolesAsignar' ])->name('users.roles.asignar')->middleware('permission:seguridad.usuarios.asignar_perfil');
    Route::get('users/roles/delete/{user}/{role}', [UserController::class, 'rolesDelete' ])->name('users.roles.delete')->middleware('permission:seguridad.usuarios.asignar_perfil');
    //permisos especiales
    Route::match(array('GET','POST'),'users/permisos/{user}',[UserController::class, 'permisos' ])->name('users.permission')->middleware('permission:seguridad.usuarios.listado.permisos_especiales');

    //perfil
    Route::get('users/perfil',[UserController::class, 'perfil' ])->name('users.perfil');
    Route::post('users/acceso',[UserController::class, 'perfilUp' ])->name('users.acceso');

    Route::get('roles', [ RoleController::class, 'viewIndex' ])->name('roles')->middleware('permission:seguridad.perfiles');
    Route::get('roles/list', [ RoleController::class, 'index' ])->name('roles.list')->middleware('permission:seguridad.perfiles');
    Route::get('roles/create', [ RoleController::class, 'create' ])->name('roles.create')->middleware('permission:seguridad.perfiles');
    Route::post('roles/store', [ RoleController::class, 'store' ])->name('roles.store')->middleware('permission:seguridad.perfiles');
    Route::get('roles/{role}/edit', [ RoleController::class, 'edit' ])->name('roles.edit')->middleware('permission:seguridad.perfiles.modificar');
    Route::post('roles/{role}/update', [ RoleController::class, 'update' ])->name('roles.update')->middleware('permission:seguridad.perfiles.modificar');
    Route::get('roles/{role}/delete', [ RoleController::class, 'delete' ])->name('roles.delete')->middleware('permission:seguridad.perfiles.eliminar');
    Route::match(array('GET', 'POST'), 'roles/{role}/permission', [ RoleController::class, 'assingPermission' ])->name('roles.permission')->middleware('permission:seguridad.perfiles.asignar_permisos');
    Route::match(array('GET', 'POST'), 'roles/estadistica/{id}', [ RoleController::class, 'estadistica' ])->name('roles.estadistica');

    //Route::view('permissions','security.permissions.listado')->name('permissions')->middleware('permission:permission-read');
    Route::match(['GET','POST'],'permissions', [ PermissionController::class, 'index' ])->name('permissions.list')->middleware('permission:seguridad.perfiles.permisos');
    Route::get('permissions/create/{name?}', [ PermissionController::class, 'create' ])->name('permissions.create')->middleware('permission:seguridad.perfiles.permisos');
    Route::post('permissions/store', [ PermissionController::class, 'store' ])->name('permissions.store')->middleware('permission:seguridad.perfiles.permisos');
    Route::get('permissions/{permission}/edit', [ PermissionController::class, 'edit' ])->name('permissions.edit')->middleware('permission:seguridad.perfiles.permisos');
    Route::post('permissions/{id}/update', [ PermissionController::class, 'update' ])->name('permissions.update')->middleware('permission:seguridad.perfiles.permisos');
    Route::get('permissions/{permission}/delete', [ PermissionController::class, 'delete' ])->name('permissions.delete')->middleware('permission:seguridad.perfiles.permisos');


    //Mantenimiento de Sucursales
   
    
    //Mantenimiento de Agencias
    Route::get('agencia', [ AgenciaController::class, 'dataIndex' ])->name('agencia')->middleware('permission:seguridad.usuarios.agencias');
    Route::get('agencia/list', [ AgenciaController::class, 'index' ])->name('agencia.list')->middleware('permission:seguridad.usuarios.agencias');
    Route::get('agencia/create', [ AgenciaController::class, 'create' ])->name('agencia.create')->middleware('permission:seguridad.usuarios.agencias');
    Route::post('agencia/store', [ AgenciaController::class, 'store' ])->name('agencia.store')->middleware('permission:seguridad.usuarios.agencias');
    Route::get('agencia/{id}/edit', [ AgenciaController::class, 'edit' ])->name('agencia.edit')->middleware('permission:seguridad.usuarios.agencias');
    Route::post('agencia/{id}/update', [ AgenciaController::class, 'update' ])->name('agencia.update')->middleware('permission:seguridad.usuarios.agencias');
    Route::get('agencia/delete/{id}', [ AgenciaController::class, 'delete' ])->name('agencia.delete')->middleware('permission:seguridad.usuarios.agencias');

?>
