<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // SUCURSAL / AGENCIA / OFICINA
            $table->unsignedBigInteger('agencia_id');
            $table->foreign('agencia_id')
                ->references('id')
                ->on('agencias');

            //DATOS DE PERSONA NATURAL
            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')
                ->references('id')
                ->on('personas');

            // DATOS DEL CARGO EN LA EMPRESA
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')
                ->references('id')
                ->on('cargos');

            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('estado')->default(1);
            $table->string('avatar',50);

            //Ultima fecha de acceso
            $table->datetime('fecha_acceso')->nullable();
            $table->datetime('fecha_acceso_fin')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
