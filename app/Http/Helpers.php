<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//use Carbon\Carbon;

// DATOS DE EMPRESA
function empresa(){
    return DB::table('empresas')->first();
}

function variables()
{
    return DB::table('variables')->first();
}

function agencia()
{
    return DB::table('agencias')->get();
}

function agencia_consolidado($user)
{
    if (userConsolidado($user)) {
        return DB::table('agencias')->get();
    }
    return DB::table('agencias')
        ->where(
            'id',
            DB::table('users')
                ->where('id', $user)
                ->first()->agencia_id,
        )
        ->get();
}

function fecha_sistema()
{
    return DB::table('sistemas')
        ->where('estado', 1)
        ->first()->fecha;
}

function modulos($user)
{
    if ($user == 1) {
        return DB::table('modules')
            ->select('id', 'module', 'url', 'icono')
            ->get();
    } else {
        return DB::table('model_has_roles as mr')
            ->join('role_has_permissions as rp', 'mr.role_id', 'rp.role_id')
            ->join('permissions as p', 'rp.permission_id', 'p.id')
            ->join('modules as m', 'p.module_id', 'm.id')
            ->where('mr.model_id', $user)
            ->groupBy('m.module', 'm.id')
            ->select('m.id', 'm.module', 'm.url', 'm.icono')
            ->get();
    }
}

function sexo()
{
    return DB::table('sexos')
        ->select('id', 'sexo')
        ->get();
}

function estadocivil()
{
    return DB::table('estadocivils')
        ->select('id', 'estadocivil')
        ->get();
}

function ocupacion()
{
    return DB::table('ocupacions')
        ->select('id', 'ocupacion')
        ->get();
}

function tipodocumento($tipopersona)
{
    $tipo = $tipopersona == 1 ? 'per_natural' : 'per_juridica';
    return DB::table('tipodocumentos')
        ->where("$tipo", 1)
        ->get();
}

function tipopersona()
{
    return DB::table('tipopersonas')
        ->select('id', 'tipopersona')
        ->get();
}

function departamentos()
{
    return DB::table('ubigeos')
        ->where('ubigeoPadre', 0)
        ->select('id', 'ubigeo')
        ->get();
}

function tipodireccion()
{
    return DB::table('tipodireccions')
        ->select('id', 'tipodireccion')
        ->get();
}

function nombre_mes(int $mes)
{
    $m = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    return $m[$mes - 1];
}

function name_agencia($agencia)
{
    return DB::table('agencias')
        ->where('id', $agencia)
        ->select('agencia')
        ->first()->agencia;
}

function direccion_principal($persona)
{
    $direccion = \App\Models\Direccion::where('persona_id', $persona)
        ->where('principal', 1)
        ->where('estado', 1)
        ->first();
    $ubigeo = is_object($direccion) ? $direccion->getUbigeo() : '';
    return is_object($direccion) ? $direccion->direccion . ' ' . $direccion->numero . ' - ' . $ubigeo->dist . ' - ' . $ubigeo->prov . ' - ' . $ubigeo->dpto : '';
}

function get_fecha_texto($fi, $ff = 0)
{
    $ff = $ff == 0 ? date('Y-m-d H:i') : $ff;
    $min1 = date('i', strtotime($fi));
    $h1 = date('H', strtotime($fi));
    $d1 = date('d', strtotime($fi));
    $m1 = date('m', strtotime($fi));
    $a1 = date('Y', strtotime($fi));

    $min2 = date('i', strtotime($ff));
    $h2 = date('H', strtotime($ff));
    $d2 = date('d', strtotime($ff));
    $m2 = date('m', strtotime($ff));
    $a2 = date('Y', strtotime($ff));

    return Carbon::create($a1, $m1, $d1, $h1, $min1)->longAbsoluteDiffForHumans(Carbon::create($a2, $m2, $d2, $h2, $min2), 6);
}

//usuarios que pueden ver el consolidado en reportes
function userConsolidado($user)
{
    return in_array($user, [1, 2, 5, 7]) ? true : false;
}
