<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pizza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('tamanho_pizza', function (Blueprint $table) {
            $table->increments('id_tamanho')->unsigned();
            $table->enum('tamanho', ['P','M','G']);
        });

        DB::table('tamanho_pizza')->insert([['tamanho' => 'P'],['tamanho' => 'M'],['tamanho' => 'G']]);

        Schema::create('sabor_pizza', function (Blueprint $table) {
            $table->increments('id_sabor')->unsigned();
            $table->string('sabor');
            $table->string('desc_sabor');
            $table->timestamps();
        });

        Schema::create('pizzas', function (Blueprint $table) {
            $table->increments('id_pizza');
            $table->decimal('preco_pizza', 8,2);
            $table->integer('id_tam_pizza')->unsigned();
            $table->boolean('disponibilidade');
            $table->integer('id_sabor_pizza')->unsigned();
            $table->integer('num_vendas')->unsigned()->default(0);
                $table->foreign('id_tam_pizza')->references('id_tamanho')->on('tamanho_pizza');
                $table->foreign('id_sabor_pizza')->references('id_sabor')->on('sabor_pizza');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('pizzas');
        Schema::dropIfExists('tamanho_pizza');
        Schema::dropIfExists('sabor_pizza');
        Schema::enableForeignKeyConstraints();
    }
}
