<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldIsRepairAndMonthForCompleteRenovationObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complete_renovation_objects', function (Blueprint $table) {
            $table->tinyInteger('month')->index()->comment('Місяць')->after('sort');
            $table->tinyInteger('is_repair')->index()->comment('В ремонті')->after('sort');
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
