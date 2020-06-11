<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->enum('nivel',[0,1,2]);
            $table->bigInteger('cpf')->unsigned();
            $table->string('nome');
            $table->string('sobrenome');
            $table->string('email')->unique();
            $table->string('passwd');
            $table->string('id_foto')->nullable();
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
        Schema::dropIfExists('usuarios');
    }
}
