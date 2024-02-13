<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up()
    {
        Schema::create('agencias', function (Blueprint $table) {
            $table->id();
            $table->string('agencia', 100);
            $table->string('nombre_corto', 30);
            $table->integer('ubigeo_id');
            $table->string('direccion', 150);
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('agencias');
    }
};
