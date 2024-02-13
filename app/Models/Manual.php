<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

class Manual extends Model
{
    use HasFactory;

    //referenciar 
    public function tipomodulo(){
        return $this->belongsTo(Tipomodulo::class);
    }

    public function registar($data)
    {
        try {
            DB::beginTransaction();

            //Almacenar imagen en disco, carpeta manuales
            $file = $data->file('archivo');
            $nom = $file->getClientOriginalName();
            $cadena = $nom; 
            $nombre = str_replace(' ', '_', $cadena);
            while (Storage::disk('manuales')->exists($nombre)) {
                $nombre = random_int(1, 9) . "" . $nombre;
            }
            Storage::disk('manuales')->put($nombre, File::get($file));

            //Almacenar datos en tabla manuales
            $this->tipomodulo_id = $data->tipomodulo_id;
            $this->manual = $data->manual;
            $this->url = $nombre;
            $this->save();

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }


    public static function modificar($id,$data) {

        $manual=Manual::find($id);
        $manual->manual=$data->manual;
        $manual->tipomodulo_id=$data->tipomodulo_id;
        return $manual->save();
    }
}
