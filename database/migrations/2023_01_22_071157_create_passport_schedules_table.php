<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('schedules_passports');
		Schema::create('passport_schedules', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->integer('passport_id')->index()->comment('Паспорт ремонту');
			$table->integer('type_service_id')->index()->comment('Тип обслуговування');
			$table->integer('periodicity')->nullable()->comment('Періодичність обслуговування в місяцях');
			$table->date('date_last_service')->nullable()->comment('Дата останього ремонту (обслуговування)');
			$table->integer('created_by')->index()->comment('Запис створив');
			$table->integer('updated_by')->index()->comment('Запис змінив');
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
        Schema::dropIfExists('create_schedules_passports');
    }
}
