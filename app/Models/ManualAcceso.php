<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Manualacceso extends Model
{
    use HasFactory;

    protected $fillable = ['area_id', 'tipomodulo_id'];

}
