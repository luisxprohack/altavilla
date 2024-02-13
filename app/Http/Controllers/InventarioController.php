<?php

namespace App\Http\Controllers;
use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InventarioController extends Controller
{
    public function dataIndex()
    {
        $view = view('ventas.inventarios.listado');
        return response()->json(['view' => "$view"]);
    }

    public function index(Request $request)
    {
        $inventario = Inventario::where('estado', $request->estado);
        return datatables()
            ->eloquent($inventario)
            ->addColumn('btn', 'ventas.inventarios.acciones')
            ->rawColumns(['btn'])
            ->toJson();
    }

    public function create()
    {
        $view = view('ventas.inventarios.nuevo');
        return response()->json([
            'title' => 'Registrar inventario',
            'view' => "$view",
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'descripcion' => 'required|max:255',
            'tipo' => 'required|max:100',
            'codigo' => 'required|unique:inventarios,codigo|max:50',
            'peso_unitario' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        $inventario = new Inventario();
        if ($inventario->registrar($request)) {
            return response()->json([
                'success' => true,
                'view' => 'Inventario registrado correctamente.',
                'datatable' => 'inventario',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'view' => 'Error al registrar el inventario.',
            ]);
        }
    }

    public function edit($id)
    {
        $inventario = Inventario::find($id);
        $view = view('ventas.inventarios.editar', compact('inventario'));
        return response()->json([
            'title' => 'Modificar Inventario',
            'view' => "$view",
        ]);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'campo1' => 'reglas_personalizadas',
            'campo2' => 'reglas_personalizadas',
            // Agrega aquí las reglas de validación necesarias para los campos de inventario
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $view = view('layouts.mensajes.validate', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'view' => "$view",
            ]);
        }

        if (Inventario::modificar($id, $request)) {
            return response()->json([
                'success' => true,
                'view' => 'Inventario modificado correctamente.',
                'datatable' => 'inventario',
            ]);
        }
    }
    public function estado($id)
    {
        $inventario = Inventario::find($id);

        if (!$inventario) {
            return response()->json([
                'success' => false,
                'mensaje' => 'El inventario no existe.',
            ]);
        }

        // Alternar entre estado 1 y 0
        $inventario->estado = $inventario->estado == 1 ? 0 : 1;
        $inventario->save();

        // Mensaje de éxito
        $accion = $inventario->estado == 1 ? 'activado' : 'desactivado';
        return response()->json([
            'success' => true,
            'mensaje' => "Inventario $accion correctamente.",
        ]);
    }
}
