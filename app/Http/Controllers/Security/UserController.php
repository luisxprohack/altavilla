<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    public function search(Request $request){
        if($request->method() == 'GET'){
            $view = view('security.users.search');
            return response()->json([
                'title' => 'Buscar usuario',
                'view'  => "$view"
            ]);
        }
        $user = [];
        if (strlen(trim($request->dato_busqueda)) > 0){
            $where = $request->tipo_busqueda == 1 ? [[ 'personas.ndocumento',$request->dato_busqueda ]]
                                              : [[ 'personas.datos','like','%'. $request->dato_busqueda. '%' ]];
            $user = User::join('personas','users.persona_id','=','personas.id')
                            ->where($where)->take(10)
                            ->select('users.id','ndocumento','datos')->get();
        }

        $view = view('security.users.listado_search', compact('user'));
        return response()->json("$view");
    }

    public function viewIndex(){
        $agencia = DB::table('agencias')->get();
        $view = view('security.users.listado', compact('agencia'));
        return response()->json(['view' => "$view"]);
    }

    public function index(Request $request){
        $agenciaMayorIgual = '=';
        if($request->agencia == 0){
            $agenciaMayorIgual = '>';
        }
        $users = User::with(['persona','cargo','agencia'])
                ->where('agencia_id', $agenciaMayorIgual, $request->agencia)
                ->where('users.id','>',1)->orderBy('estado','DESC');
        return datatables()
            ->eloquent($users)
            ->addColumn('btn', 'security.users.acciones')
            ->addColumn('estado', function($user){
                return $user->estado ? "<span class='badge badge-success'>Habilitado</span>" : "<span class='badge badge-danger'>Deshabilitado</span>";
            })
            ->rawColumns(['btn','estado'])
            ->toJson();
    }

    public function show($id){
        $user = User::with('persona')->find($id);
        $view = view('security.users.view', compact('user'));
        return response()->json([
            'title'  => 'Vista general de usuarios',
            'view'   => "$view"
        ]);
    }

    public function create(){
        $agencia = DB::table('agencias')->get();
        $area = DB::table('areas')->get();
        $view = view('security.users.nuevo', compact('area','agencia'));
        return response()->json([
            'title' => 'Registro de Usuarios',
            'view'  => "$view"
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'persona_value' => 'exists:personas,id|unique:users,persona_id',
            'cargo'         => 'exists:cargos,id',
            'agencia'      => 'exists:agencias,id',
            'usuario'       => 'required|unique:users,username',
            'password'      => 'required|min:6|max:15|confirmed',
            'email'         => 'required|unique:users,email'
        ],[
            'persona_value.exists' => 'La persona no existe.',
            'persona_value.unique' => 'La persona ya tiene un usuario registrado.',
        ]);

        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        if(DB::table('personas')->find($request->persona_value)->tipopersona_id == 2){
            return response()->json([
                'success' => FALSE,
                'view'    => "Las personas juridicas no pueden tener usuario en el sistema."
            ]);
        }

        $model = new User();
        $model->register($request);
        return response()->json([
            'success' => TRUE,
            'view'    => "Usuario registrado correctamente",
            'datatable' => 'users'
        ]);
    }

    public function edit($user){
        $user = User::find($user);
        $area = DB::table('areas')->get();
        $cargos = DB::table('cargos')->where('area_id', $user->cargo->area_id)->get();
        $agencia = DB::table('agencias')->get();
        $view = view('security.users.editar', compact('user','area','cargos','agencia'));
        return response()->json([
            'title' => 'Modificar datos de usuario',
            'view'  => "$view"
        ]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'cargo'         => 'exists:cargos,id',
            'usuario'       => 'required|unique:users,username,' . $id,
            'email'         => 'required|unique:users,email,' . $id,
            'password'      => 'max:15|confirmed',
        ]);

        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        User::modificar($request, $id);

        return response()->json([
            'success'   => TRUE,
            'view'      => "Usuario modificado correctamente",
            'datatable' => 'users',
            'edit'      => ''
        ]);
    }

    public function active($user,$estado){
        $user = User::find($user);
        $user->estado = $estado;
        $user->save();

        $mensaje = 'Usuario habilitado correctamente!';

        if($estado == 0){ 
            // Lista los permisos que no esta asignado en algun rol
            $permissions = Permission::whereNotIn('id', function($query) use($user){
                $query->select('permission_id')->from('role_has_permissions')
                      ->join('roles','role_has_permissions.role_id','roles.id')
                      ->join('model_has_roles','roles.id','model_has_roles.role_id')
                      ->where('model_has_roles.model_id',$user->id);
            })
            ->whereNotIn('id',[15,16,17,18,19])
            ->get();

            //elimina todo los permisos del rol
            $user->revokePermissionTo($permissions);

            //elimina todos los roles asignados
            foreach($user->getRole() as $item){
                $user->removeRole($item->id);
            }
            $mensaje = 'Usuario deshabilitado correctamente';
        }

        return response()->json([
            'success' => true,
            'mensaje' => "$mensaje"
        ]);
    }

    // Asignar roles
    public function viewRoles(){
        $agencia = DB::table('agencias')->get();
        $view = view('security.users.roles.listado', compact('agencia'));
        return response()->json(['view' => "$view"]);
    }

    public function roles(Request $request){
        $agenciaMayorIgual = '=';
        if($request->agencia == 0){
            $agenciaMayorIgual = '>';
        }
        $users = User::with(['persona','agencia'])
                ->where('agencia_id', $agenciaMayorIgual, $request->agencia)
                ->where('users.id','>',1)->where('users.estado',1);
        return datatables()
            ->eloquent($users)
            ->addColumn('btn', 'security.users.roles.acciones')
            ->addColumn('listadoPerfiles', function($user){
                return $user->getRole();
            })
            ->addColumn('perfil', 'security.users.roles.perfil')         
            ->rawColumns(['btn','perfil'])
            ->toJson();
    }

    public function rolesAsignar($user, Request $request){
        $user = User::find($user);
        if($request->method() == 'GET'){
            $roles = DB::table('roles')->select('id','name')->where('id','>',1)->get();
            $view = view('security.users.roles.nuevo', compact('roles','user'));
            return response()->json([
                'title' => 'Asignar Perfil',
                'view'  => "$view"
            ]);
        }

        if(!$request->has('role')){
            $mensaje='Debe seleccionar un Perfil.';
            $success = false;
        }elseif($user->hasRole($request->role)){
            $mensaje='El usuario ya tiene asignado el Perfil seleccionado';
            $success = false;
        }elseif($request->role == 'super-admin'){
            $mensaje='Por seguridad este Perfil no puede ser asignado a los usuarios.';
            $success = false;
        }else{
            $user->assignRole($request->role);
            $mensaje = 'Perfil asignado correctamente';
            $success = true;
        }

        return response()->json([
            'success'   => $success,
            'view'      => $mensaje,
            'datatable' => 'perfiles'
        ]);
    }

    public function rolesDelete($user, $role){
        $user = User::find($user);
        $user->removeRole($role);
        return response()->json([
            'success' => true,
            'mensaje' => "Perfil quitado correctamente"
        ]);
    }

    //permisos especiales
    public function permisos($user, Request $request){
        $user = User::find($user);

        $permissions = Permission::whereNotIn('id', function($query) use($user){
            $query->select('permission_id')->from('role_has_permissions')
                  ->join('roles','role_has_permissions.role_id','roles.id')
                  ->join('model_has_roles','roles.id','model_has_roles.role_id')
                  ->where('model_has_roles.model_id',$user->id);
        })
        ->whereNotIn('id',[19])
        ->get();

        if($request->method() == 'GET'){
            $view = view('security.users.permission_especial', [
                'permissions' => $permissions,
                'user'        => $user
            ]);
            return response()->json([
                'title' => 'Permisos disponibles por asignar',
                'view'  => "$view"
            ]);
        }

        try{
            DB::beginTransaction();

            //elimina todo los permisos del rol
            $user->revokePermissionTo($permissions);

            if($request->has('permisos_especial')){
                for($i=0; $i < count($request->permisos_especial); $i++) {
                    $jerarquias = explode('.', $request->permisos_especial[$i]);
                    for($j=0; $j< count($jerarquias) - 1 ; $j++){
                        if($j==0){ $namePermiso = $jerarquias[0]; }
                        elseif($j==1){ $namePermiso = $jerarquias[0].'.'.$jerarquias[1]; }
                        elseif($j==2){ $namePermiso = $jerarquias[0].'.'.$jerarquias[1].'.'.$jerarquias[2]; }

                        $permiso = Permission::where('name',$namePermiso)->select('id')->first();
                        if(!$user->hasPermissionTo($permiso->id)){
                            $user->givePermissionTo($permiso->id);
                        }
                    }
                    $user->givePermissionTo($request->permisos_especial);
                }
                $mensaje = 'Permisos asignados correctamente';
            }else{
                $mensaje = 'No se ha realizado ninguna acción.';
            }

            DB::commit();
            $success = TRUE;
        }catch(Exception $e){
            $success = FALSE;
            $mensaje = 'Estimado usuario se ha presentado una excepción, vuelva a intentarlo.';
        }

        return response()->json([
            'success'   => $success,
            'view'      => $mensaje,
            'edit'      => '',
            'datatable' => 'users'
        ]);
    }

    //PERFIL DE USUARIO
    public function perfil(){
        $user = auth()->user();
        $persona = $user->persona;
        $personanatural = DB::table('personanaturals')->where('persona_id',$persona->id)->first();
        $view = view('security.users.perfil', compact('user','personanatural','persona'));
        return response()->json([
            'title' => 'Modificar mis datos',
            'view'  => "$view"
        ]);
    }

    public function perfilUp(Request $request){
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'password'      => 'required|min:6|max:15|confirmed',
        ]);        

        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        $nUser = User::find($user->id);
        $nUser->password = bcrypt($request->password);
        $nUser->save();
        
        // Eliminamos la sesion
        $request->session()->invalidate();

        return response()->json([
            'success'   => TRUE,
            'view'      => "Información modificada correctamente",
            'dataview'  => '',
            'edit'      => ''
        ]);
    }
}
