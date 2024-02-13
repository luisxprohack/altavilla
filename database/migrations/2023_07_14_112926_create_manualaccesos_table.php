<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualAccesosTable extends Migration
{
    public function up()
    {
        Schema::create('manualaccesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('tipomodulo_id');
            $table->timestamps();

            $table
                ->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('cascade');
            $table
                ->foreign('tipomodulo_id')
                ->references('id')
                ->on('tipomodulos')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('manualaccesos');
    }
}
