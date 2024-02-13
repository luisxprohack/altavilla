<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CargoController extends Controller
{
    public function dataIndex(){
        $area = DB::table('areas')->get();
        $view = view('security.users.cargos.listado', compact('area'));
        return response()->json(['view' => "$view"]);
    }

    public function index(Request $request){
        $areaMayorIgual='>';
        if($request->area > 0){ $areaMayorIgual = '='; }
        $cargos = Cargo::with(['area'])
                        ->where('area_id', $areaMayorIgual , $request->area)
                        ->orderBy('area_id');
        return datatables()
            ->eloquent($cargos)
            ->addColumn('btn', 'security.users.cargos.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function create(){
        $area = DB::table('areas')->get();
        $view = view('security.users.cargos.nuevo', compact('area'));
        return response()->json([
            'title' => 'Registrar cargo',
            'view'  => "$view"
        ]);
    }

    public function store(Request $request){
        $rules = [
            'area'        => 'exists:areas,id',
            'cargo'      => 'required|max:50|unique:cargos,cargo',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        $model = new Cargo();
        $model->area_id = $request->area;
        $model->cargo   = $request->cargo;
        if($model->save()){
            return response()->json([
                'success'   => TRUE,
                'view'      => 'Cargo registrado correctamente.',
                'datatable' => 'cargos'
            ]);
        }
    }

    public function edit($id){
        $area = DB::table('areas')->get();
        $cargo = Cargo::find($id);
        $view = view('security.users.cargos.editar', compact('area','cargo'));
        return response()->json([
            'title' => 'Modificar cargo',
            'view'  => "$view"
        ]);
    }

    public function update($id, Request $request){
        $rules = [
            'area'        => 'exists:areas,id',
            'cargo'       => 'required|max:50|unique:cargos,cargo,' . $id,
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        $model = Cargo::find($id);
        $model->area_id = $request->area;
        $model->cargo   = $request->cargo;
        if($model->save()){
            return response()->json([
                'success'   => TRUE,
                'view'      => 'Cargo modificado correctamente.',
                'datatable' => 'cargos'
            ]);
        }
    }

    public function delete($id){
        if(DB::table('users')->where('cargo_id', $id)->count() > 0){
            return response()->json([
                'success' => FALSE,
                'mensaje' => 'El cargo ya esta asignado'
            ]);
        }
        
        Cargo::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'mensaje' => "Cargo eliminado."
        ]);
    }

    public function getCargo($area){
        return response()->json(Cargo::select('id','cargo as campoValor')->where('area_id', $area)->get());
    }

}
