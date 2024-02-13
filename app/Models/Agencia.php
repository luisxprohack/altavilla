<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class Agencia extends Model
{
    use HasFactory;

    public function registrar($data)
    {
        try {
            DB::beginTransaction();

            $this->agencia = strtoupper($data->agencia);
            $this->nombre_corto = strtoupper($data->nombre_corto);
            $this->ubigeo_id = $data->distrito;
            $this->direccion = $data->direccion;
            $this->telefono = $data->telefono;
            $this->save();

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
    public static function modificar($id, $data)
    {
        $agencia = Agencia::find($id);
        $agencia->agencia = strtoupper($data->agencia);
        $agencia->nombre_corto = strtolower($data->nombre_corto);
        $agencia->ubigeo_id = $data->distrito;
        $agencia->direccion = $data->direccion;
        $agencia->telefono = $data->telefono;
        return $agencia->save();
    }

    public function getUbigeo()
    {
        return Ubigeo::join('ubigeos as prov', 'ubigeos.ubigeoPadre', 'prov.id')
            ->join('ubigeos as dpto', 'prov.ubigeoPadre', 'dpto.id')
            ->where('ubigeos.id', $this->ubigeo_id)
            ->select('ubigeos.ubigeo as dist', 'prov.ubigeo as prov', 'dpto.ubigeo as dpto')
            ->first();
    }
}


