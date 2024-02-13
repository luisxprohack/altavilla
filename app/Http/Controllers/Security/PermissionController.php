<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use DB;

class PermissionController extends Controller
{
    public function index(Request $request){
        $permissions = Permission::orderBy('name', 'ASC')->select('id','name')->get();
        
        if ($request->method == 'POST'){
            $view = view('security.permissions.buscar', ['permissions' => $permissions->toArray()]);
            return response()->json([
                'view' => "$view"
            ]);
        }

        $view = view('security.permissions.listado', ['permissions' => $permissions->toArray()]);
        return response()->json(['view' => "$view"]);
    }

    public function create($name='')
    {   
        $view = view('security.permissions.nuevo', compact('name'));
        return response()->json([
            'title' => 'Crear Nuevo Permiso',
            'view'   => "$view"
        ]);
    }

    public function store(Request $request)
    {
        $nombre = $request->jerarquia == '' ? $request->nombre : $request->jerarquia . '.' . $request->nombre;

        $validator = Validator::make([
            'nombre' => $nombre
        ],[
            'nombre'      => 'required|unique:permissions,name'
        ],[ 'nombre.unique' => 'El nombre del permiso ya esta registrado.' ]);

        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success'  => FALSE,
                'view'     => "$view"
            ]);
        }
        
        Permission::create([ 'name' =>  $nombre ]);
        return response()->json([
            'success' => TRUE,
            'view'    => "Permiso registrado correctamente",
            'dataview' => 'btnpermission',
        ]);
    }

    public function edit(Permission $permission)
    {
        $view = view('security.permissions.editar', compact('permission'));
        return response()->json([
            'title' => 'Modificar Permiso',
            'view'   => "$view"
        ]);
    }

    public function update($id, Request $request)
    {
        $permission = Permission::find($id);
        $namePermisoEntrada = $request->nombreCompleto .''. $request->nombre;

        $validator = Validator::make([
            'nombre' => $namePermisoEntrada
        ],[
            'nombre' => 'required|unique:permissions,name,' . $permission->id,
        ],[ 'nombre.unique' => 'El nombre del permiso ya está registrado.' ]);

        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success'  => FALSE,
                'view'     => "$view"
            ]);
        }

        $permission->name = $namePermisoEntrada;
        $permission->save();

        return response()->json([
            'success'  => TRUE,
            'view'     => "Permiso modificado correctamente",
            'dataview' => 'btnpermission',
            'edit'     => ''
        ]);
    }

    public function delete($id)
    {
        $permission = Permission::find($id);
        if (Permission::where('name', 'like', "%$permission->name.%")->count() > 0) {
            return response()->json([
                'success' => FALSE,
                'mensaje' => "Se encontraron permisos que dependen del permiso <strong>$permission->name</strong>, no es posible eliminar."
            ]);
        }

        $permission->delete();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json([
            'success' => TRUE,
            'mensaje'    => "Permiso eliminado correctamente"
        ]);
    }
}
