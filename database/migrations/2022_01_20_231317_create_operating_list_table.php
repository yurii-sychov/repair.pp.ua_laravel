<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatingListTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::dropIfExists('operating_list');
		Schema::create('operating_list', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->integer('subdivision_id')->index()->comment('Підрозділ');
			$table->integer('complete_renovation_object_id')->index()->comment('Повне найменування об`єкту ремонту');
			$table->integer('specific_renovation_object_id')->index()->comment('Об`єкт ремонту	');
			$table->integer('place_id')->index()->comment('Місце встановлення об`єкту ремонту	');
			$table->integer('passport_id')->index()->comment('Паспорт');
			$table->date('service_date')->comment('Дата обслуговування');
			$table->string('service_data')->comment('Дані обслуговування');
			$table->string('executor', 50)->comment('Виконавець');
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
		Schema::dropIfExists('operating_list');
	}
}
