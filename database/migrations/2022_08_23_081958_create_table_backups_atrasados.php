<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBackupsAtrasados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backups_atrasados', function (Blueprint $table) {
            $table->id();
            $table->string('id_bakcups');
            $table->string('sistemas');
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
        Schema::dropIfExists('backups_atrasados');
    }
}
