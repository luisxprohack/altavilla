<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonanaturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personanaturals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('persona_id');
                $table->foreign('persona_id')
                    ->references('id')
                    ->on('personas');
            $table->unsignedBigInteger('estadocivil_id');
                $table->foreign('estadocivil_id')
                    ->references('id')
                    ->on('estadocivils');
            $table->unsignedBigInteger('sexo_id');
                $table->foreign('sexo_id')
                    ->references('id')
                    ->on('sexos');
            $table->unsignedBigInteger('ocupacion_id');
                $table->foreign('ocupacion_id')
                    ->references('id')
                    ->on('ocupacions');

            $table->string('nombres',50);
            $table->string('apaterno',50);
            $table->string('amaterno',50);
            $table->date('fecha_nacimiento')->nullable(); 
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
        Schema::dropIfExists('personanaturals');
    }
}
