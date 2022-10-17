<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnFromBackupsAtrasados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('backups_atrasados', function (Blueprint $table) {
            $table->string('dias_atrasados')->nullable()->after('total');
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
            $table->dropColumn('dias_atrasados');
        });
    }
}
