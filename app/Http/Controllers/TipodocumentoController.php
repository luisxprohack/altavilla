<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipodocumento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TipodocumentoController extends Controller
{
    
    public function index()
    {
        $tipodocumentos = Tipodocumento::get();
        $view = view("personas.tipodocumento.listado", compact('tipodocumentos'));
        return response()->json(['view' => "$view"]);
    }

    public function create()
    {
        $view = view('personas.tipodocumento.nuevo');
        return response()->json([
            'view'   => "$view",
            'title'  => 'Agregar Tipo Documento'
        ]);
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre'      => 'required|max:50|unique:tipodocumentos,tipodocumento',
            'abreviatura' => 'required|max:20|unique:tipodocumentos,nombre_corto',
            'caracteres'  => 'required|integer|min:5',
        ]);
        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        $model = new Tipodocumento();
        $model->register($request);

        return response()->json([
            'success'  => true,
            'view'     => "Tipodocumento agregado exitosamente",
            'dataview' => 'btntipodocumento'
        ]);
    }

    public function edit($id)
    {
        $tipodocumento = Tipodocumento::find($id);
        $view = view('personas.tipodocumento.editar', compact('tipodocumento'));
        return response()->json([
            'view'  => "$view",
            'title' => 'Modificar tipo documento'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre'      => 'required|max:50|unique:tipodocumentos,tipodocumento,' . $id,
            'abreviatura' => 'required|max:20|unique:tipodocumentos,nombre_corto,'. $id,
            'caracteres'  => 'required|integer|min:5',
        ]);
        if($validator->fails()){
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => FALSE,
                'view'    => "$view"
            ]);
        }

        Tipodocumento::modificar($request, $id);

        return response()->json([
            'success'  => true,
            'view'     => "Tipodocumento modificado exitosamente",
            'dataview' => 'btntipodocumento'
        ]);
    }

    public function destroy($id)
    {
        if(DB::table('personas')->where('tipodocumento_id', $id)->count() > 0){
            $success = FALSE;
            $mensaje = 'El tipo documento esta siendo usado en el sistema, no podra eliminar.';
        }else{
            Tipodocumento::where('id', $id)->delete();
            $success = TRUE;
            $mensaje = 'Tipo documento eliminado.';
        }

        return response()->json([
            'success' => $success,
            'mensaje'    => $mensaje
        ]);
    }

    public function getTipoDocumentos($tipopersona){
        $tipo = $tipopersona == 1 ? 'per_natural' : 'per_juridica';
        $data = Tipodocumento::where("$tipo",1)->select('id', 'nombre_corto as campoValor')->get();
        return response()->json($data);
    }
}
