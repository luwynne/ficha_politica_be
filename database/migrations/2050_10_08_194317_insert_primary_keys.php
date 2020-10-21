<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertPrimaryKeys extends Migration
{
    
    public function up(){

        Schema::table('cidades', function (Blueprint $table) {
            $table->foreign('estado_id')->references('id')->on('estados');
        });

        Schema::table('mandatos', function (Blueprint $table) {
            $table->foreign('partido_id')->references('id')->on('partidos');
            $table->foreign('politico_id')->references('id')->on('politicos');
        });

        Schema::table('ministros', function (Blueprint $table) {
            $table->foreign('ministerio_id')->references('id')->on('ministerios');
            
        });

        Schema::table('prefeitos', function (Blueprint $table) {
            
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });

        Schema::table('vereadores', function (Blueprint $table) {
           
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });

        Schema::table('governadores', function (Blueprint $table) {
            
            $table->foreign('estado_id')->references('id')->on('estados');
        });

        Schema::table('deputados_estaduais', function (Blueprint $table) {
            
            $table->foreign('estado_id')->references('id')->on('estados');
        });

        /*Schema::table('deputados_federais', function (Blueprint $table) {
            $table->foreign('mandato_id')->references('id')->on('mandatos');
        });

        Schema::table('senadores', function (Blueprint $table) {
            $table->foreign('mandato_id')->references('id')->on('mandatos');
        });

        Schema::table('presidentes', function (Blueprint $table) {
            $table->foreign('mandato_id')->references('id')->on('mandatos');
        });*/

        Schema::table('projetos', function (Blueprint $table) {
            $table->foreign('tipo_id')->references('id')->on('tipo_projetos');
            $table->foreign('mandato_id')->references('id')->on('mandatos');
        });

        Schema::table('votos_projetos', function (Blueprint $table) {
            $table->foreign('projeto_id')->references('id')->on('projetos');
            $table->foreign('mandato_id')->references('id')->on('mandatos');
        });

        Schema::table('processos', function (Blueprint $table) {
            $table->foreign('mandato_id')->references('id')->on('mandatos');
            $table->foreign('tipo_id')->references('id')->on('tipos_processos');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
