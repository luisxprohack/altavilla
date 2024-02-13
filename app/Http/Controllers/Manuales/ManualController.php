<?php

namespace App\Http\Controllers\Manuales;
use App\Http\Controllers\Controller;
use App\Models\Manual;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ManualController extends Controller
{
    public function index(Request $request)
    {
        $estado = 1;

        if (isset($request->estado)) {
            $estado = $request->estado;
        }
        $manual = Manual::with('tipomodulo')
            ->where('estado', $estado)
            ->orderBy('tipomodulo_id')
            ->get();

        if (isset($request->estado)) {
            $view = view('manuales.buscar', compact('manual', 'estado'));
        } else {
            $view = view('manuales.listado2', compact('manual', 'estado'));
        }

        return response()->json(['view' => "$view"]);
    }

    public function home()
    {
        $user = auth()->user();
        $cargo = $user->cargo;

        $tipomodulos = DB::table('tipomodulos')
            ->join('manualaccesos', function ($join) use ($cargo) {
                $join->on('tipomodulos.id', '=', 'manualaccesos.tipomodulo_id')->where('manualaccesos.area_id', $cargo->area_id);
            })
            ->join('manuals', 'tipomodulos.id', '=', 'manuals.tipomodulo_id')
            ->where('manuals.estado', 1)
            ->get();

        $view = view('manuales.home', compact('tipomodulos'));
        return response()->json(['view' => "$view"]);
    }

    public function create()
    {
        $tipomodulos = DB::table('tipomodulos')->get();

        $view = view('manuales.nuevo', compact('tipomodulos'));
        return response()->json([
            'title' => 'Registar Manual',
            'view' => "$view",
        ]);
    }

    public function store(Request $request)
    {
        $uniqueRule = Rule::unique('manuals', 'manual')->where('estado', 1);

        $rules = [
            'manual' => ['max:100', $uniqueRule],
            'archivo' => 'required|mimes:pdf',
            'tipomodulo_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $model = new Manual();
        if ($model->registar($request)) {
            return response()->json([
                'success' => true,
                'view' => 'Manual registrado correctamente.',
                'dataview' => 'btnmanual',
            ]);
        }
    }

    public function edit($id)
    {
        $manual = Manual::find($id);
        $tipomodulos = DB::table('tipomodulos')->get();

        $view = view('manuales.editar', compact('manual', 'tipomodulos'));
        return response()->json([
            'title' => 'Editar Manual',
            'view' => "$view",
        ]);
    }

    public function update($id, Request $request)
    {
        $uniqueRule = Rule::unique('manuals', 'manual')->where('estado', 1)->ignore($id);

        $rules = ['manual' => ['max:100', $uniqueRule]];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        if (Manual::modificar($id, $request)) {
            return response()->json([
                'success' => true,
                'view' => 'Manual modificado correctamente.',
                'dataview' => 'btnmanual',
            ]);
        }
    }

    public function status($manual, $status)
    {
        $manual = Manual::find($manual);
        $manual->estado = $status;
        $manual->save();

        // Eliminar el documento correspondiente si el estado es 0
        if ($status == 0) {
            $documento = $manual->url;
            Storage::disk('manuales')->delete($documento);
        }

        $mensaje = 'Manual eliminado correctamente!';
        return response()->json([
            'success' => true,
            'mensaje' => $mensaje,
        ]);
    }

    public function show($filename)
    {
        $path = storage_path('app/public/manuales/' . $filename);
        return response()->file($path);
    }
}
