<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function dataIndex()
    {
        $view = view('personas.listado');
        return response()->json(['view' => "$view"]);
    }

    public function index(Request $request)
    {
        $personas = Persona::with(['tipopersona', 'tipodocumento'])
            ->where('estado', $request->estado)
            ->orderByDesc('personas.estado');
        return datatables()
            ->eloquent($personas)
            ->addColumn('btn', 'personas.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function search(Request $request, $tipo)
    {
        $where = $request->cb_filtro == 1 ? [['documento', $request->data]] : [['datos', 'like', '%' . $request->data . '%']];
        switch ($tipo) {
            case 0:
                //CLIENTES O PROVEEDORES
                $persona = Persona::where($where)->where('estado', 1)->take(10)->get();
                break;
            case 1:
                //BUSCANDO USUARIOS
                $persona = Persona::join('users as u', 'personas.id', 'u.persona_id')->join('sucursals as s', 'u.sucursal_id', 's.id')->where($where)->where('u.estado', 1)->select('datos', 'documento', 'u.id', 's.sucursal')->take(10)->get();
                break;
        }

        $view = view('personas.listado_search', compact('persona', 'tipo'));
        return response()->json([
            'view' => "$view",
        ]);
    }

    public function create()
    {
        $view = view('personas.nuevo');
        return response()->json([
            'title' => 'Registro de persona',
            'view' => "$view",
        ]);
    }

    public function store(Request $request)
    {
        $caracteres = DB::table('tipodocumentos')
            ->where('id', $request->tipodocumento)
            ->first()->caracter;
        $rules = [
            'tipopersona' => 'exists:tipopersonas,id',
            'tipodocumento' => 'exists:tipodocumentos,id',
            'documento' => "digits:$caracteres|unique:personas,documento",
            'telefono' => 'max:20',
            'telefono_adicional' => 'max:20',
            'email' => 'max:150',
            'email_adicional' => 'max:150',
        ];

        if ($request->tipopersona == 1) {
            $rules['apellido_paterno'] = 'required|max:50';
            $rules['apellido_materno'] = 'required|max:50';
            $rules['nombres'] = 'required|max:50';
            $rules['fecha_nacimiento'] = 'date';
            $rules['estadovicil'] = 'exists:estadocivils,id';
        } else {
            $rules['razon_social'] = 'required|unique:personajuridicas,razon_social|max:150';
            $rules['nombre_comercial'] = 'required|max:150';
            $rules['fecha_constitucion'] = 'date';
            $rules['actividad_economica'] = 'max:150';
        }

        if ($request->envia_direccion == 1) {
            $rules['distrito'] = 'required|exists:ubigeos,id';
            $rules['direccion'] = 'required|max:150';
            $rules['referencia'] = 'max:100';
            $rules['numero'] = 'max:20';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $model = new Persona();
        $mensaje = 'Hubo un error, por favor comuniquese con el administrador del sistema';
        $success = false;
        if ($model->register($request)) {
            $mensaje = 'Persona registrada correctamente';
            $success = true;
        }

        return response()->json([
            'success' => $success,
            'view' => $mensaje,
            'datatable' => 'personas',
        ]);
    }

    public function edit($persona)
    {
        $persona = Persona::with('direccion')->find($persona);
        $view = view('personas.editar', compact('persona'));
        return response()->json([
            'title' => 'Modificar datos',
            'view' => "$view",
        ]);
    }

    public function update($id, Request $request)
    {
        $persona = Persona::find($id);

        $rules = [
            'telefono' => 'max:20',
            'telefono_adicional' => 'max:20',
            'email' => 'max:150',
            'email_adicional' => 'max:150',
        ];

        $accesUpdateDocummento = auth()->user()->hasRole('admin');
        if ($accesUpdateDocummento) {
            $caracteres = DB::table('tipodocumentos')
                ->where('id', $persona->tipodocumento_id)
                ->first()->caracter;
            $rules['documento'] = "digits:$caracteres|unique:personas,documento," . $id;
        }

        if ($persona->tipopersona_id == 1) {
            $rules['apellido_paterno'] = 'required|max:50';
            $rules['apellido_materno'] = 'required|max:50';
            $rules['nombres'] = 'required|max:50';
            $rules['fecha_nacimiento'] = 'date';
            $rules['estadovicil'] = 'exists:estadocivils,id';
        } else {
            $juridica = DB::table('personajuridicas')->where('persona_id', $id)->first()->id;
            $rules['razon_social'] = 'required|max:150|unique:personajuridicas,razon_social,' . $juridica;
            $rules['nombre_comercial'] = 'required|max:150';
            $rules['fecha_constitucion'] = 'date';
            $rules['actividad_economica'] = 'max:150';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $mensaje = 'Hubo un error, por favor comuniquese con el administrador del sistema';
        $success = false;
        if (Persona::modificar($id, $request, $accesUpdateDocummento)) {
            $mensaje = 'Persona actualizada correctamente';
            $success = true;
        }

        return response()->json([
            'success' => $success,
            'view' => $mensaje,
            'datatable' => 'personas',
        ]);
    }

    public function active($persona, $estado)
    {
        $persona = Persona::find($persona);
        $persona->estado = $estado;
        $persona->save();

        $mensaje = 'Persona eliminada correctamente!';

        if ($estado == 1) {
            $mensaje = 'Persona re-ingresada correctamente';
        }

        return response()->json([
            'success' => true,
            'mensaje' => "$mensaje",
        ]);
    }

    // MANTENIMIENTO DE DIRECCIONES

    public function direccionList($persona)
    {
        $direccion = \App\Models\Direccion::where('persona_id', $persona)->where('estado', 1)->orderByDesc('principal')->get();
        $view = view('personas.direcciones.buscar', compact('direccion'));
        return response()->json([
            'view' => "$view",
        ]);
    }

    public function direccionCreate()
    {
        $view = view('personas.direcciones.nuevo');
        return response()->json([
            'title' => 'Registrar dirección',
            'view' => "$view",
        ]);
    }

    public function direccionStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'distrito' => 'required|exists:ubigeos,id',
            'direccion' => 'required|max:150',
            'referencia' => 'max:80',
            'tipodireccion' => 'exists:tipodireccions,id',
        ]);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $direccionPrincipal = 0;
        if ($request->has('direccion_principal')) {
            DB::table('direccions')
                ->where('persona_id', $request->persona_direccion)
                ->update([
                    'principal' => 0,
                ]);
            $direccionPrincipal = 1;
        }
        if (
            DB::table('direccions')
                ->where('persona_id', $request->persona_direccion)
                ->where('estado', 1)
                ->count() == 0
        ) {
            $direccionPrincipal = 1;
        }

        DB::table('direccions')->insert([
            'tipodireccion_id' => $request->tipodireccion,
            'ubigeo_id' => $request->distrito,
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'principal' => $direccionPrincipal,
            'persona_id' => $request->persona_direccion,
        ]);

        return response()->json([
            'success' => true,
            'view' => 'Dirección registrada.',
            'dataview' => 'btndirecciones',
        ]);
    }

    public function direccionEdit($id)
    {
        $direccion = \App\Models\Direccion::with('ubigeo')->find($id);
        $ubigeo = DB::table('ubigeos as dist')
            ->join('ubigeos as prov', 'dist.ubigeoPadre', 'prov.id')
            ->join('ubigeos as dpto', 'prov.ubigeoPadre', 'dpto.id')
            ->where('dist.id', $direccion->ubigeo_id)
            ->select('dist.ubigeoPadre as dist', 'prov.ubigeoPadre as prov', 'dpto.ubigeoPadre as dpto', 'dist.id as idDist', 'prov.id as idProv', 'dpto.id as idDpto')
            ->first();

        $provincias = DB::table('ubigeos')
            ->where('ubigeoPadre', $ubigeo->prov)
            ->select('id', 'ubigeo')
            ->get();
        $distritos = DB::table('ubigeos')
            ->where('ubigeoPadre', $ubigeo->dist)
            ->select('id', 'ubigeo')
            ->get();
        $view = view('personas.direcciones.editar', compact('provincias', 'distritos', 'direccion', 'ubigeo'));

        return response()->json([
            'title' => 'Modificar dirección',
            'view' => "$view",
        ]);
    }

    public function direccionUpdate($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'distrito' => 'required|exists:ubigeos,id',
            'direccion' => 'required|max:150',
            'referencia' => 'max:100',
            'tipodireccion' => 'exists:tipodireccions,id',
        ]);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        DB::table('direccions')
            ->where('id', $id)
            ->update([
                'tipodireccion_id' => $request->tipodireccion,
                'ubigeo_id' => $request->distrito,
                'direccion' => $request->direccion,
                'referencia' => $request->referencia,
            ]);

        if ($request->has('direccion_principal')) {
            $dir = DB::table('direccions')->where('id', $id)->first();
            DB::table('direccions')
                ->where('persona_id', $dir->persona_id)
                ->update([
                    'principal' => 0,
                ]);

            DB::table('direccions')
                ->where('id', $id)
                ->update([
                    'principal' => 1,
                ]);
        }

        return response()->json([
            'success' => true,
            'view' => 'Dirección modificada.',
            'dataview' => 'btndirecciones',
        ]);
    }

    public function direccionDelete($id)
    {
        DB::table('direccions')->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Dirección eliminada correctamente',
        ]);
    }

    //ubigeo
    public function getSelectedUbigeo($ubigeo)
    {
        //provincias, distritos
        $data = DB::table('ubigeos')->where('ubigeoPadre', $ubigeo)->select('id', 'ubigeo as campoValor')->get();
        return response()->json($data);
    }

    //Consulta DNI-Reniec
    public function consultaDNI($dni)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://apiperu.dev/api/dni/$dni?api_token=a54b33320517227514fbe8fdee57c680b860b40646d04d56e3c681775f747cd3",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return response()->json(json_decode($response));
    }
}
