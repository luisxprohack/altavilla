<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    use HasFactory;

    public function register($data){
        $this->tipodocumento  = $data->nombre;
        $this->nombre_corto   = $data->abreviatura;
        $this->per_natural    = $data->per_natural;
        $this->per_juridica   = $data->per_juridica;
        $this->caracter       = $data->caracteres;
        $this->save();
    }

    public static function modificar($data, $id){
        $model = Tipodocumento::find($id);
        $model->tipodocumento  = $data->nombre;
        $model->nombre_corto   = $data->abreviatura;
        $model->per_natural    = $data->per_natural;
        $model->per_juridica   = $data->per_juridica;
        $model->caracter       = $data->caracteres;
        $model->save();
    }

}
