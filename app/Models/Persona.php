<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    use HasFactory;
    
    protected $fillable = ['tipopersona_id', 'tipodocumento_id','documento','datos','telefono'];

    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumento::class);
    }

    public function tipopersona()
    {
        return $this->belongsTo(Tipopersona::class);
    }

    public function personanatural(){
        return $this->hasOne(Personanatural::class);
    }

    public function personajuridica(){
        return $this->hasOne(Personajuridica::class);
    }

    public function direccion(){
        return $this->hasMany(Direccion::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function register($data){
        try {
            DB::beginTransaction();
            //REGISTRO DE DATOS DE PERSONA
            $this->tipopersona_id = $data->tipopersona;
            $this->tipodocumento_id = $data->tipodocumento;
            $this->documento = $data->documento;
            $datos = $data->tipopersona == 1 ? "$data->apellido_paterno $data->apellido_materno $data->nombres" : $data->razon_social;
            $this->datos = strtoupper(str_replace("'",'',str_replace('"','',$datos)));
            $this->telefono = '' . $data->telefono;
            $this->telefono_adicional = '' . $data->telefono_adicional;
            $this->email = '' . $data->email;
            $this->email_adicional = '' . $data->email_adicional;
            $this->save();

            //REGISTRO DE TIPOPERSONA
            if($data->tipopersona == 1){
                Personanatural::insert([
                    'nombres'          => strtoupper(str_replace("'",'',str_replace('"','',$data->nombres))),
                    'apaterno'         => strtoupper(str_replace("'",'',str_replace('"','',$data->apellido_paterno))),
                    'amaterno'         => strtoupper(str_replace("'",'',str_replace('"','',$data->apellido_materno))),
                    'fecha_nacimiento' => isset($data->fecha_nacimiento) ? date('Y-m-d') : date('Y-m-d', strtotime($data->fecha_nacimiento)),
                    'sexo_id'          => $data->sexo,
                    'persona_id'       => $this->id,
                    'estadocivil_id'   => $data->estadocivil,
                    'ocupacion_id'     => $data->ocupacion
                ]);
            }else{
                Personajuridica::insert([
                    'persona_id'         => $this->id,
                    'razon_social'       => strtoupper(str_replace("'",'',str_replace('"','',$data->razon_social))),
                    'nombre_comercial'   => strtoupper($data->nombre_comercial),
                    'fecha_constitucion' => isset($data->fecha_constitucion) ? date('Y-m-d') : date('Y-m-d', strtotime($data->fecha_constitucion)),
                    'actividad_economica'=> $data->actividad_economica
                ]);
            }

            //REGISTRO DE DIRECCIONES
            if($data->envia_direccion == 1){
                Direccion::insert([
                    'tipodireccion_id' => $data->tipodireccion,
                    'ubigeo_id'        => $data->distrito,
                    'direccion'        => $data->direccion,
                    'referencia'       => $data->referencia,
                    'principal'        => 1,
                    'persona_id'       => $this->id
                ]);
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function modificar($id, $data, $accesUpdateDocummento){
        try {
            DB::beginTransaction();
            //REGISTRO DE DATOS DE PERSONA
            $persona = Persona::find($id);
            if($accesUpdateDocummento) {
                $persona->documento = $data->documento;
            }
            $datos = $persona->tipopersona_id == 1 ? "$data->apellido_paterno $data->apellido_materno $data->nombres" : $data->razon_social;
            $persona->datos = strtoupper(str_replace("'",'',str_replace('"','',$datos)));
            $persona->telefono = '' . $data->telefono;
            $persona->telefono_adicional = '' . $data->telefono_adicional;
            if($persona->email != $data->email){
                User::where('persona_id', $id)->update([
                    'email' => '' . $data->email
                ]);
            }
            $persona->email = '' . $data->email;
            $persona->email_adicional = '' . $data->email_adicional;
            $persona->save();

            //REGISTRO DE TIPOPERSONA
            if($persona->tipopersona_id == 1){
                Personanatural::where('persona_id',$id)->update([
                    'nombres'          => strtoupper(str_replace("'",'',str_replace('"','',$data->nombres))),
                    'apaterno'         => strtoupper(str_replace("'",'',str_replace('"','',$data->apellido_paterno))),
                    'amaterno'         => strtoupper(str_replace("'",'',str_replace('"','',$data->apellido_materno))),
                    'fecha_nacimiento' => isset($data->fecha_nacimiento) ? date('Y-m-d') : date('Y-m-d', strtotime($data->fecha_nacimiento)),
                    'sexo_id'          => $data->sexo,
                    'estadocivil_id'   => $data->estadocivil,
                    'ocupacion_id'     => $data->ocupacion
                ]);

                //Modificar imagen si estuviera registrado como usuario y haya modificado el sexo
                DB::table('users')->where('persona_id',$id)->update([
                    'avatar' => $data->sexo == 1 ? 'avatar_m.png' : 'avatar_f.png'
                ]);
            }else{
                Personajuridica::where('persona_id',$id)->update([
                    'razon_social'       => strtoupper(str_replace("'",'',str_replace('"','',$data->razon_social))),
                    'nombre_comercial'   => strtoupper($data->nombre_comercial),
                    'fecha_constitucion' => isset($data->fecha_constitucion) ? date('Y-m-d') : date('Y-m-d', strtotime($data->fecha_constitucion)),
                    'actividad_economica'=> $data->actividad_economica
                ]);
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
