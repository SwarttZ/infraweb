<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableErrosBackupMensagem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erros_backup_mensagem', function (Blueprint $table) {
            $table->id();
            $table->string('entidade_id');
            $table->string('nome_servidor');
            $table->string('mensagem_erro');
            $table->string('data_backup');
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
        Schema::dropIfExists('erros_backup_mensagem');
    }
}
