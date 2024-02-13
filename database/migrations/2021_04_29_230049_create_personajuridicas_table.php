<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonajuridicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personajuridicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id');
                $table->foreign('persona_id')
                    ->references('id')
                    ->on('personas');
            $table->string('razon_social',150);
            $table->string('nombre_comercial', 150);
            $table->date('fecha_constitucion')->nullable();
            $table->string('actividad_economica',255)->nullable();
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
        Schema::dropIfExists('personajuridicas');
    }
}
