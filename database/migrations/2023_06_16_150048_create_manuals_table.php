<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('manuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipomodulo_id');
            $table
                ->foreign('tipomodulo_id')
                ->references('id')
                ->on('tipomodulos');

            $table->string('manual', 100);
            $table->string('url');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manuals');
    }
};
