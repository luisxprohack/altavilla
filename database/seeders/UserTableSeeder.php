<?php

namespace Database\Seeders;
use Illuminate\Support\Str;

use App\Models\{
    Agencia,
    User,
        Sucursal,
        Tipodocumento,
        Tipopersona,
        Estadocivil,
        Tipodireccion,
        Sexo,
        Persona,
        Area,
        Cargo,
        Personanatural,
        Ocupacion,
        Sistema
};

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    
    public function run()
    {
        
        // Crear Tipopersona
        Tipopersona::insert([
            [ 'tipopersona'  => 'NATURAL', 'nombre_corto' => 'N' ],
            [ 'tipopersona'  => 'JURIDICA', 'nombre_corto' => 'J' ]
        ]);

        // Crear Tipodocumento
        Tipodocumento::insert([
            [ 'tipodocumento' => 'Documento Nacional de Indentidad', 'nombre_corto'  => 'DNI', 'per_natural' => 1, 'per_juridica' => 0, 'caracter' => 8  ],
            [ 'tipodocumento' => 'Registro Unico de Contribuyente',  'nombre_corto'  => 'RUC', 'per_natural' => 0, 'per_juridica' => 1, 'caracter' => 11 ]
        ]);

        // Crear Persona
        $persona = Persona::create([
            'tipopersona_id'   => Tipopersona::where('id',1)->first()->id,
            'tipodocumento_id' => Tipodocumento::where('id',1)->first()->id,
            'datos'            => 'LUIS ENRIQUE SALAZAR RENGIFO',
            'documento'        => '75140174',
            'email'            => 'luis.hack10@gmail.com',
            'telefono'         => '903065875',
        ]); 

        // Crear Estadocivil
        Estadocivil::insert([
            [ 'estadocivil'  => 'SOLTERO(A)','nombre_corto' => 'S' ],
            [ 'estadocivil'  => 'CASADO(A)','nombre_corto' => 'C' ],
            [ 'estadocivil'  => 'CONVIVIENTE','nombre_corto' => 'C' ],
            [ 'estadocivil'  => 'VIUDO(A)','nombre_corto' => 'V' ]
        ]);
        // Crear Sexo
        Sexo::insert([
            ['sexo' => 'Masculino', 'nombre_corto' => 'M' ],
            ['sexo' => 'Femenino', 'nombre_corto' => 'F' ]
        ]);

        $ocupacion = Ocupacion::create([
            'ocupacion' => 'INGENIERO', 'nombre_corto' => 'INGENIERO'
        ]);

        Personanatural::create([
            'nombres'          => 'LUIS ENRIQUE',
            'apaterno'         => 'SALAZAR',
            'amaterno'         => 'RENGIFO',
            'fecha_nacimiento' => '2001-03-22',
            'sexo_id'          => Sexo::where('id',1)->first()->id,
            'persona_id'       => $persona->id,
            'estadocivil_id'   => Estadocivil::where('id',1)->first()->id,
            'ocupacion_id'     => $ocupacion->id
        ]);

        // Crear Sucursal
        $agencia = Agencia::create([
            'agencia'      => 'PRINCIPAL',
            'nombre_corto' => 'PRINCIPAL',

            // JAEN - JAEN- CAJAMARCA
            'ubigeo_id'    => 857,

            'direccion'    => 'Jaen',
            'telefono'     => ''
        ]);
        // Crear Area
        $area = Area::create([
            'area'         => 'TECNOLOGIA DE INFORMACION',
            'nombre_corto' => 'TI'
        ]);
        // Crear Cargo
        $cargo = Cargo::create([
            'cargo'    => 'ADMINISTRADOR DEL SISTEMA',
            'area_id'  => $area->id
        ]);

        // Crea usuario
        $user = User::create([
            'agencia_id'        => $agencia->id,
            'persona_id'        => $persona->id,
            'cargo_id'          => $cargo->id,
            'username'          => 'luisxprohack',
            'email'             => 'luis.hack10@gmail.com',
            'estado'            => 1,
            'email_verified_at' => now(),
            'password'          => bcrypt('secret'),
            'avatar'            => 'avatar_m.png',
            'remember_token'    => Str::random(10)
        ]);

        // Crear tipo direccion
        Tipodireccion::insert([
            ['tipodireccion' => 'DOMICILIO'],
            ['tipodireccion' => 'TRABAJO'],
            ['tipodireccion' => 'DEL NEGOCIO']
        ]);

        //Iniciar fecha de sistema
        Sistema::insert([
            'user_id' => $user->id,
            'fecha'   => date('Y-m-d'),
            'estado'  => 1
        ]);
    }
}
