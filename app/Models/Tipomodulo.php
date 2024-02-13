<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Tipomodulo extends Model
{
    use HasFactory;

    public function manualAccesos()
    {
        return $this->hasMany(ManualAcceso::class);
    }

    public function registrar($data)
    {
        try {
            DB::beginTransaction();

            $this->tipomodulo = strtoupper($data->tipomodulo);
            $this->color = $data->color;
            $this->save();

            $areas = $data->input('acceso', []);
            foreach ($areas as $area) {
                $manualAcceso = new ManualAcceso();
                $manualAcceso->area_id = $area;
                $manualAcceso->tipomodulo_id = $this->id;
                $manualAcceso->save();
            }
            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

   public static function modificar($id, $data)
{
    $tipomodulo = Tipomodulo::find($id);
    $tipomodulo->tipomodulo = strtoupper($data->tipomodulo);
    $tipomodulo->color = $data->color;
    $tipomodulo->save();

    $tipomodulo->manualAccesos()->delete(); // Eliminar los accesos existentes

    foreach ($data->acceso as $area_id) {
        $tipomodulo->manualAccesos()->create(['area_id' => $area_id]);
    }

    return true;
}


}
