<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableServidoresEveo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servidores_eveo', function (Blueprint $table) {
            $table->id();
            $table->string('eveo_arquivos');
            $table->string('eveo_hostname');
            $table->string('eveo_ip_interno');
            $table->string('eveo_ip_externo');
            $table->string('eveo_portas');
            $table->string('eveo_func_server');
            $table->string('eveo_erros_genericos');
            $table->string('eveo_logs_erros_apache');
            $table->string('eveo_logs_servidor');
            $table->string('eveo_server_ssh');
            $table->string('eveo_os');
            $table->string('eveo_server_disco');
            $table->string('eveo_server_ram');
            $table->string('eveo_server_dns');            
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
        Schema::dropIfExists('servidores_eveo');
    }
}
