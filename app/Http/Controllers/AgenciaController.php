<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Agencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AgenciaController extends Controller
{
    public function dataIndex()
    {
        $view = view('security.users.agencia.listado');
        return response()->json(['view' => "$view"]);
    }

    public function index(Request $request)
    {
        $agencia = Agencia::orderBy('id');
        return datatables()
            ->eloquent($agencia)
            ->addColumn('btn', 'security.users.agencia.acciones')
            ->addColumn('ubigeo', function ($agencia) {
                $u = $agencia->getUbigeo();
                return $u->dpto . ' - ' . $u->prov . ' - ' . $u->dist;
            })
            ->rawColumns(['btn', 'ubigeo'])
            ->toJson();
    }

    public function create()
    {
        $view = view('security.users.agencia.nuevo');
        return response()->json([
            'title' => 'Registrar agencia',
            'view' => "$view",
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'agencia' => 'unique:agencias,agencia|max:100',
            'nombre_corto' => 'required|max:30',
            'distrito' => 'required|exists:ubigeos,id',
            'direccion' => 'required|max:150',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $model = new Agencia();
        if ($model->registrar($request)) {
            return response()->json([
                'success' => true,
                'view' => 'Agencia registrada correctamente.',
                'datatable' => 'agencia',
            ]);
        }
    }

    public function edit($id)
    {
        $agencia = Agencia::find($id);
        $ubigeo = DB::table('ubigeos as dist')
            ->join('ubigeos as prov', 'dist.ubigeoPadre', 'prov.id')
            ->join('ubigeos as dpto', 'prov.ubigeoPadre', 'dpto.id')
            ->where('dist.id', $agencia->ubigeo_id)
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
        $view = view('security.users.agencia.editar', compact('agencia', 'provincias', 'distritos', 'ubigeo'));
        return response()->json([
            'title' => 'Modificar Agencia',
            'view' => "$view",
        ]);
    }
    
    public function update($id, Request $request)
    {
        $rules = [
            'agencia' => 'max:100|unique:agencias,agencia,' . $id,
            'nombre_corto' => 'required|max:30',
            'distrito' => 'required|exists:ubigeos,id',
            'direccion' => 'required|max:150',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        if (Agencia::modificar($id, $request)) {
            return response()->json([
                'success' => true,
                'view' => 'Agencia modificada correctamente.',
                'datatable' => 'agencia',
            ]);
        }
    }

    public function delete($id)
    {
        if (
            DB::table('users')
                ->where('agencia_id', $id)
                ->count() > 0
        ) {
            return response()->json([
                'success' => false,
                'mensaje' => 'La Agencia tiene usuarios activos, no podra ser eliminada.',
            ]);
        }

        //Elimina la gencia de BD
        Agencia::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Agencia eliminada.',
        ]);
    }

    
}
