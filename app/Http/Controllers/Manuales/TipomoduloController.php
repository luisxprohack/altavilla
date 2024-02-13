<?php

namespace App\Http\Controllers\Manuales;
use App\Http\Controllers\Controller;
use App\Models\ManualAcceso;
use App\Models\Tipomodulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TipomoduloController extends Controller
{
    public function dataIndex()
    {
        $view = view('manuales.tipomodulos.listado');
        return response()->json(['view' => "$view"]);
    }

    public function index()
    {
        $tipomodulo = Tipomodulo::join('manualaccesos', 'tipomodulos.id', '=', 'manualaccesos.tipomodulo_id')
            ->join('areas', 'manualaccesos.area_id', '=', 'areas.id')
            ->select('tipomodulos.*', DB::raw("GROUP_CONCAT(CONCAT('[', areas.area, ']')) as acceso"))
            ->groupBy('tipomodulos.id')
            ->orderBy('id');

        return datatables()
            ->eloquent($tipomodulo)
            ->addColumn('btn', 'manuales.tipomodulos.acciones')
            ->addColumn('acceso', function ($tipomodulo) {
                return  $tipomodulo->acceso;
            })
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function create()
    {
        $areas = DB::table('areas')->get();
        //dd($areas);
        $view = view('manuales.tipomodulos.nuevo', compact('areas'));
        return response()->json([
            'title' => 'Registrar Tipo de Modulo',
            'view' => "$view",
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'tipomodulo' => 'unique:tipomodulos,tipomodulo|max:50',
            'color' => 'required|max:20',
            'acceso' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $tipomodulo = new Tipomodulo();
        if ($tipomodulo->registrar($request)) {
            return response()->json([
                'success' => true,
                'view' => 'Tipo modulo registrado correctamente.',
                'datatable' => 'tipomodulo',
            ]);
        }
    }

    public function edit($id)
    {

        $areas = DB::table('areas')->get();
        $tipomodulo = Tipomodulo::find($id);
        $access = DB::table('areas')
            ->join('manualaccesos', 'areas.id', '=', 'manualaccesos.area_id')
            ->where('manualaccesos.tipomodulo_id', $id)
            ->get();

        $view = view('manuales.tipomodulos.editar', compact('tipomodulo', 'areas','access'));
        return response()->json([
            'title' => 'Editar Tipo de Modulo',
            'view' => "$view",
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'tipomodulo' => 'max:50|unique:tipomodulos,tipomodulo,' . $id,
            'color' => 'required|max:20',
            'acceso' => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        if (Tipomodulo::modificar($id, $request)) {
            return response()->json([
                'success' => true,
                'view' => 'Tipo modulo modificado correctamente.',
                'datatable' => 'tipomodulo',
            ]);
        }
    }

    public function delete($id)
    {
        if (
            DB::table('manuals')
                ->where('tipomodulo_id', $id)
                ->count() > 0
        ) {
            return response()->json([
                'success' => false,
                'mensaje' => 'El Modulo contiene manuales, no podra ser eliminado.',
            ]);
        }

        Tipomodulo::where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'mensaje' => 'Tipo modulo eliminado.',
        ]);
    }
}
