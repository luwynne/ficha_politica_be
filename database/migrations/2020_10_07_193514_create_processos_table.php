<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao');
            $table->string('protocolo');
            $table->boolean('finalizado');
            $table->boolean('culpado');
            $table->text('url')->nullable();
            $table->integer('mandato_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('politico_id')->unsigned(); // relator do processo
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
        Schema::dropIfExists('processos');
    }
}
