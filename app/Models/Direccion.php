<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Direccion extends Model
{
    use HasFactory;
    
    protected $fillable = ['tipodireccion_id', 'ubigeo_id','direccion','referencia','principal','persona_id'];


    public function getUbigeo(){ 
        return Ubigeo::join('ubigeos as prov','ubigeos.ubigeoPadre','prov.id')
                ->join('ubigeos as dpto','prov.ubigeoPadre','dpto.id')
                ->where('ubigeos.id', $this->ubigeo_id)
                ->select('ubigeos.ubigeo as dist','prov.ubigeo as prov','dpto.ubigeo as dpto')->first();
    }

    public function ubigeo(){
        return $this->belongsTo(Ubigeo::class);
    }

    public function tipodireccion(){
        return $this->belongsTo(Tipodireccion::class);
    }
}
