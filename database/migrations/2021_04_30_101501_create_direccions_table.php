<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipodireccion_id');
                $table->foreign('tipodireccion_id')
                    ->references('id')
                    ->on('tipodireccions');
            $table->unsignedBigInteger('ubigeo_id');
                $table->foreign('ubigeo_id')
                    ->references('id')
                    ->on('ubigeos');
            $table->string('direccion',255);
            $table->string('referencia',80)->nullable();
            $table->integer('principal');
            $table->boolean('estado')->default(1);
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas');
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
        Schema::dropIfExists('direccions');
    }
}
