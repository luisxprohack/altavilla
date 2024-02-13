<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personanatural extends Model
{
    use HasFactory;

    public function ocupacion(){
        return $this->belongsTo(Ocupacion::class);
    }

    public function sexo(){
        return $this->belongsTo(Sexo::class);
    }
}
