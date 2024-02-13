<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    public function agencia(){
        return $this->belongsTo(Agencia::class);
    }

    public function register($data){
        $this->agencia_id = $data->agencia;
        $this->persona_id = $data->persona_value;
        $this->cargo_id   = $data->cargo;
        $this->username = strtoupper($data->usuario);
        $this->email = $data->email;
        $this->estado = 1;
        $this->password = bcrypt($data->password);
        $per = Persona::find($data->persona_value);
        $this->avatar = $per->personanatural->sexo == 'M' ? 'avatar_m.png' : 'avatar_f.png';
        
        $persona = Persona::find($data->persona_value);
        if($persona->email != $data->email){
            $persona->email = $data->email;
            $persona->save();
        }  

        return $this->save();
    }

    public static function modificar($data, $id){
        $user = User::find($id);
        $user->username = strtoupper($data->usuario);
        $user->cargo_id = $data->cargo;
        $user->email = $data->email;
        $user->agencia_id = $data->agencia;

        $persona = Persona::find($user->persona_id);        
        if($persona->email != $data->email){
            $persona->email = $data->email;
            $persona->save();
        }  

        if($data->password != ''){
            $user->password = bcrypt($data->password);
        }
        $user->save();
    }

    public function getRole(){
        return DB::table('model_has_roles')
                ->join('roles','roles.id','model_has_roles.role_id')
                ->where('model_id', $this->id)
                ->select('name','id')
                ->get();
    }

    public function getName(){
        return Str::limit($this->persona->datos, 15, '...');
    }

    //SELECCIONAR LA CAJA ACTUAL - APERUTADA
    public function caja(){
        return $this->hasOne(Caja::class)->where('estado',1);
    }
}
