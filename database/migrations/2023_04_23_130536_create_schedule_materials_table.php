<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_materials', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            // $table->integer('id')->autoIncrement()->comment('ID');
            $table->integer('schedule_id')->index()->comment('Запис з графіку');
            $table->integer('material_id')->index()->comment('Матеріал');
            $table->year('year_service')->comment('Рік обслуговування');
            $table->boolean('is_extra_material')->index()->comment('Це додатковий матеріал?');
            $table->integer('created_by')->comment('Запис створив');
            $table->integer('updated_by')->comment('Запис змінив');
            $table->timestamp('created_at')->nullable()->comment('Час створення запису');
            $table->timestamp('updated_at')->nullable()->comment('Час зміни запису');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_materials');
    }
}
