<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroRemotoTableComputer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('backups_atrasados', function (Blueprint $table) {
            $table->string('psm_entity')->nullable()->after('datahora_envio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('backups_atrasados', function (Blueprint $table) {
            $table->dropColumn('psm_entity');
        });
    }
}
