<?php

namespace App\Http\Controllers\Security;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function viewIndex(){
        $view = view('security.roles.listado');
        return response()->json(['view' => "$view"]);
    }

    public function index(){
        $roles = Role::where('id','>',1);
        return datatables()
            ->eloquent($roles)
            ->addColumn('btn', 'security.roles.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function create()
    {
        $view = view('security.roles.nuevo');
        return response()->json([
            'title' => 'Registrando Perfil',
            'view'   => "$view"
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre'      => 'required|unique:roles,name',
            'descripcion' => 'required|max:50'
        ],[ 'nombre.unique' => 'El nombre del perfil ya esta registrado.' ]);

        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success'  => FALSE,
                'view'     => "$view"
            ]);
        }

        Role::create(['name' => $request->nombre, 'description' => $request->descripcion]);
        return response()->json([
            'success' => TRUE,
            'view'    => "Perfil registrado correctamente",
            'datatable' => 'roles'
        ]);
    }

    public function assingPermissionExample(Request $request){
        $role = Role::find($request->role);
        try {
            DB::beginTransaction();
            //total de permisos por el modulo seleccionado
            $totalPermissions = Permission::where('module_id',$request->module)->get();
            //elimina todo los permisos del rol
            $role->revokePermissionTo($totalPermissions);

            foreach ($totalPermissions as $value) {
                if ($request->has('permiso' . $value->id )) {
                    $role->givePermissionTo($value->id);
                }
            }

            DB::commit();
            $permissions = Permission::where('module_id',$request->module)->orderBy('name','ASC')->get();
            $view = view('seguridad.roles.refreshPermission', compact('role','permissions'));
            $estado = TRUE;
        } catch (Exception $ex) {
            $view = view('mensajes.mensaje')->with('msj', "ha ocurrido un error por favor intente nuevamente.")
                ->with('valor', 0);
                $estado=FALSE;
        }

        return response()->json([
            'success' => $estado,
            'view'    => "$view"
        ]);
    }

    public function edit(Role $role)
    {
        $view = view('security.roles.editar', compact('role'));
        return response()->json([
            'title' => 'Modificar Perfil',
            'view'   => "$view"
        ]);
    }

    public function update($role, Request $request)
    {
        $role = Role::find($role);
        $validator = Validator::make($request->all(),[
            'nombre' => 'required|unique:roles,name,' . $role->id,
            'descripcion' => 'required|max:50'
        ],[ 'nombre.unique' => 'El nombre del rol ya esta registrado.' ]);

        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success'  => FALSE,
                'view'     => "$view"
            ]);
        }

        $role->name        = $request->nombre;
        $role->description = $request->descripcion;
        $role->save();

        return response()->json([
            'success' => TRUE,
            'view'    => "Perfil modificado correctamente",
            'edit'  => '',
            'datatable' => 'roles'
        ]);
    }

    public function delete(Role $role)
    {
        if (DB::table('model_has_roles')->where('role_id',$role->id)->count() > 0) {
            return response()->json([
                'success' => FALSE,
                'mensaje' => "El Perfil <strong>$role->name</strong> está siendo usado, quite las relaciones para poder eliminar."
            ]);
        }

        DB::table('role_has_permissions')->where('role_id',$role->id)->delete();
        $role->delete();

        return response()->json([
            'success' => TRUE,
            'mensaje'    => "Perfil eliminado correctamente",
            'datatable' => 'roles'
        ]);
    }

    public function assingPermission(Role $role, Request $request){
        if($request->method() == 'GET'){
            $permissions = Permission::orderBy('name', 'ASC')->whereNotIn('id',[19])->select('id','name')->get();
            $view = view('security.roles.assingPermissions', [
                'permissions' => $permissions->toArray(),
                'role'        => $role->id
            ]);
            return response()->json([
                'title' => 'Asignar permisos al Perfil: ' . $role->name,
                'view'  => "$view"
            ]);
        }

        try{
            DB::beginTransaction();
            //total de permisos por el modulo seleccionado
            $totalPermissions = Permission::get();
            //elimina todo los permisos del rol
            $role->revokePermissionTo($totalPermissions);
            $model = new \App\Models\SpatieEAB();

            foreach ($totalPermissions as $value) {
                if ($request->has('p' . $value->id )) {
                    $jerarquias = explode('.', $value->name);
                    for($i=0; $i< count($jerarquias) - 1 ; $i++){
                        if($i==0){ $namePermiso = $jerarquias[0]; }
                        elseif($i==1){ $namePermiso = $jerarquias[0].'.'.$jerarquias[1]; }
                        elseif($i==2){ $namePermiso = $jerarquias[0].'.'.$jerarquias[1].'.'.$jerarquias[2]; }

                        $permiso = Permission::where('name',$namePermiso)->select('id')->first();
                        if(!$model->getPermissionRole($role->id,$permiso->id)){
                            $role->givePermissionTo($permiso->id);
                        }
                    }
                    $role->givePermissionTo($value->id);
                }
            }
            DB::commit();
            $success = TRUE;
            $mensaje = 'Permisos asignados correctamente';
        }catch(Exception $e){
            $success = FALSE;
            $mensaje = 'Estimado usuario se ha presentado una excepción, vuelva a intentarlo.';
        }

        return response()->json([
            'success' => $success,
            'view'    => $mensaje,
            'edit'  => '',
            'datatable' => 'roles'
        ]);
    }

    public function estadistica($id, Request $request){
        if($request->method() == 'GET'){
            $view = view('security.roles.estadisticaUp', compact('id'));
            return response()->json([
                'title' => 'Asignar o Quitar estadísticas',
                'view'  => "$view"
            ]);
        }

        DB::table('estadisticas')->where('role_id', $id)->delete();
        $seleccionados = isset($request->estadistica) ? count($request->estadistica) : 0;
        for($i=0; $i<$seleccionados;$i++){
            DB::table('estadisticas')->insert([
                'role_id'      => $id,
                'estadistica'  => $request->estadistica[$i]
            ]);
        }

        return response()->json([
            'success'   => TRUE,
            'view'      => 'Estadisticas actualizadas correctamente',
            'edit'      => '',
            'datatable' => 'roles'
        ]);
    }
}
