<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
 
class ParametrizarController extends Controller
{
    public function index($table, Request $request){
        $datos = DB::table($table)->orderBy('id')->get();
        $view = view("layouts.parametricas.$table", compact('datos'));
        return response()->json(['view' => "$view"]);
    }

    public function create($table){
    	$view = view("layouts.parametricas.agregar", compact('table'));
        $nombreTable = substr($table, 0, -1);
    	return response()->json([
    		'title' => "Agregar $nombreTable",
    		'view'   => "$view"
      	]);
    }

    public function store(Request $request){
    	if ($request->ajax()) {

    		$table     = $request->table;
    		$attribute = substr($table, 0, -1);

    	    $validator = Validator::make($request->all(),[
                'nombre'       => "required|unique:$table,$attribute",
                'abreviatura'  => 'required|max:15'
            ]);
            if ($validator->fails()) {
                $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
                return response()->json([
                    'success'  => FALSE,
                    'view'     => "$view"
                ]);
            }

            DB::table("$table")->insert([
            	"$attribute"    => strtoupper($request->nombre),
                'nombre_corto'  => strtoupper($request->abreviatura)
            ]);

            return response()->json([
                'success'  => true,
                'view'     => "Registro agregado exitosamente",
                'dataview' => 'btnparametrizar'
            ]);
    	}
    }

    public function edit($id,$table){
		$attribute =  substr($table, 0, -1);

    	$model = DB::table($table)->select('id',"$attribute as nombre",'nombre_corto')->find($id);
    	$view = view("layouts.parametricas.editar", compact('model','table'));

    	return response()->json([
    		'title' => "Modificar $attribute",
            'view'  => "$view"
    	]);
    }

    public function update($id, Request $request){
    	if ($request->ajax()) {

    		$table     = $request->table;
    		$attribute = substr($table, 0, -1);

    	    $validator = Validator::make($request->all(),[
                'nombre'       => "required|unique:$table,$attribute," . $id,
                'abreviatura'  => 'required|max:15'
            ]);
            if ($validator->fails()) {
                $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
                return response()->json([
                    'success'  => FALSE,
                    'view'     => "$view"
                ]);
            }

            DB::table("$table")->where('id',$id)->update([
            	"$attribute"    => strtoupper($request->nombre),
                'nombre_corto'  => strtoupper($request->abreviatura)
            ]);

            return response()->json([
                'success'  => true,
                'view'     => "Registro modificado exitosamente",
                'edit'     => '',
                'dataview' => 'btnparametrizar'
            ]);
    	}
    }

    public function destroy($id,$table,$relaciones){

    	$attribute = substr($table, 0, -1) . '_id';
    	$count = 0;
    	switch ($relaciones) {
    		case 1:
    			$count = DB::table('personas')->where("$attribute",$id)->count();
    			break;
    		case 2:
    			$count = DB::table('users')->where("$attribute",$id)->count();
                break;
            case 3:
                $count = DB::table('personanaturals')->where("$attribute",$id)->count();
                break;
            case 4:
                $count = DB::table('cargos')->where("$attribute",$id)->count();
                break;
            case 5:
                $count = DB::table('articulos')->where("$attribute",$id)->count();
                break;
            case 6:
                $count = DB::table('bancos')->where("$attribute",$id)->count();
                break;
    	}

    	if ($count > 0) {
            $mensaje = "El registro tiene relaciones en el sistema, que dependen del mismo, no es posible eliminar.";
            $success = false;
    	}else{
            DB::table("$table")->where('id',$id)->delete();
            $mensaje = "Registro eliminado correctamente.";
            $success = true;
        }

        return response()->json([
            'success' => $success,
            'mensaje'    => $mensaje
        ]);
    }
}
