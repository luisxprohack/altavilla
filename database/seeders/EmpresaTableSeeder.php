<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{ 
    Empresa,
    Variable
};

class EmpresaTableSeeder extends Seeder
{

    public function run()
    {
        //Crear Empresa
        Empresa::create([
            'ruc'          => '20480014678',
            'razon_social' => "Cooperativa de Ahorro y Credito Norandino",
            'nombre_corto' => "Coopac Norandino",
            
            // JAEN - JAEN- CAJAMARCA 
            'ubigeo_id'    => 857,

            'direccion'    => 'Jaen',
            'email'        => '',
            'telefono'     => '',
        ]);

        Variable::create([
            // CONFIG PRESENTACION
            'igv'                  => 18.0000,
            'titulo'               => '2eab.com', 
            'logo'                 => 'logo.png',
            'icono'                => 'logo-mini-white.png',
            'favicon'              => 'favicon.ico',
            'bg_tema'              => '#25476a',
            'color_link_header'    => '#fff',
            'color_link_dashboard' => '#F0F1F6',
            'btn_tema'             => '#25476a',
            'btn_alert'            => '#25476a',
            'nav_icon'             => '#77B1A9',
            'orientacion'          => '1'
        ]);

    }
}
