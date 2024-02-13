<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            // DATOS GENERALES
            $table->string('ruc',11);
            $table->string('razon_social',150);
            $table->string('nombre_corto',30);
            $table->integer('ubigeo_id');
            $table->string('direccion',150);
            $table->string('email',100);
            $table->string('telefono',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
