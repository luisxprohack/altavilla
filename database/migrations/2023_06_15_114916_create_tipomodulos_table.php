<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tipomodulos', function (Blueprint $table) {
            $table->id();
            $table->string('tipomodulo',50);                
            $table->string('color',20);

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tipomodulos');
    }
};
