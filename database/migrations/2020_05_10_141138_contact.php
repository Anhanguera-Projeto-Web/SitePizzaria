<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Contact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('contatos', function (Blueprint $table) {
            $table->increments('id_contato');
            $table->enum('assunto',['1','2','3','4','5']);
            $table->string('titulo_contato');
            $table->integer('cep');
            $table->string('cidade');
            $table->string('logradouro');
            $table->string('nome_requerente');
            $table->string('mail_requerente');
            $table->bigInteger('cpf_requerente');
            $table->longtext('txt_chamado');
            $table->enum('lido', ['sim','nao'])->default('nao');
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
        Schema::dropIfExists('contatos');
    }
}
