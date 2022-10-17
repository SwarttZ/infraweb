<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableStatusServico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_servico', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('host');
            $table->string('porta');
            $table->string('status');
            $table->string('erro_codigo');
            $table->string('servidor');
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
        Schema::dropIfExists('status_servico');
    }
}
