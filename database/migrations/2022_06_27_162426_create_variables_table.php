<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesTable extends Migration
{
    
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            //VARIABLES OPERATIVAS
            $table->decimal('igv',8,4);
            $table->integer('time_minutos_alerta')->default(10);

            //ESTOLOS DE DISEÑO
            $table->string('titulo',15);
            $table->string('logo',50);
            $table->string('icono',50);
            $table->string('favicon',50);
            $table->char('bg_tema',7);
            $table->char('color_link_header',7);
            $table->char('color_link_dashboard',7);
            $table->char('btn_tema',7);
            $table->char('btn_alert',7);
            $table->char('nav_icon',7);
            // 1=left, 2=top
            $table->integer('orientacion')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
