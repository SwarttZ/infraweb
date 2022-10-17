<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableServers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {

            $table->id();
            $table->string('filename')->nullable();
            $table->string('hostname');
            $table->string('tipoServico');
            $table->string('ipv4');                      
            $table->string('linkSaida');
            $table->string('qtdMemoria');
            $table->string('sisOperacional');
            $table->string('vinculoLicenca');
            $table->string('tags_hd_primario')->nullable();
            $table->string('tags_hd_secundario')->nullable();
            $table->string('programasInstalados')->nullable();
            $table->string('sistemasQs')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::table('servers', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
