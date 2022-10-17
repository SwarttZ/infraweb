<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCorrompidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corrompidos', function (Blueprint $table) {
            $table->id();
            $table->string('id_entidade');
            $table->string('id_sistemas');
            $table->string('corrompido');
            $table->string('tamanho_banco');
            $table->string('datahora_envio');
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
        Schema::dropIfExists('corrompidos');
    }
}
