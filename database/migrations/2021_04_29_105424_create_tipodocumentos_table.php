<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipodocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipodocumentos', function (Blueprint $table) {
            $table->id();
            $table->string('tipodocumento',50);
            $table->string('nombre_corto',20);
            $table->boolean('per_natural');
            $table->boolean('per_juridica');
            $table->integer('caracter');
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
        Schema::dropIfExists('tipodocumentos');
    }
}
