<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class Inventario extends Model
{
    use HasFactory;

    public function registrar($data)
    {
        try {
            DB::beginTransaction();

            $this->descripcion = strtoupper($data->descripcion);
            $this->tipo = strtoupper($data->tipo);
            $this->codigo = strtoupper($data->codigo);
            $this->peso_unitario = $data->peso_unitario;
            $this->save();

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function modificar($id, $data)
    {
        $inventario = Inventario::find($id);
        $inventario->descripcion = strtoupper($data->descripcion);
        $inventario->tipo = strtoupper($data->tipo);
        $inventario->codigo = strtoupper($data->codigo);
        $inventario->peso_unitario = $data->peso_unitario;
        $inventario->estado = $data->estado;
        return $inventario->save();
    }
}
