<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipopersona_id');
            $table->foreign('tipopersona_id')
                ->references('id')
                ->on('tipopersonas');
            $table->unsignedBigInteger('tipodocumento_id');
                $table->foreign('tipodocumento_id')
                    ->references('id')
                    ->on('tipodocumentos');

            $table->char('documento',18);
            $table->string('datos',150);
            $table->string('telefono',20)->nullable();
            $table->string('telefono_adicional',20)->nullable();
            $table->string('email',150)->nullable();
            $table->string('email_adicional',150)->nullable();
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('personas');
    }
}
