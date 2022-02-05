<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPassportsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('passports', function (Blueprint $table) {
			$table->string('type')->nullable()->after('place_id')->comment('Тип об`єкту ремонту');
			$table->date('production_date')->nullable()->after('type')->comment('Дата изготовления');
			$table->string('number', 20)->nullable()->after('production_date')->comment('Номер об`єкту ремонту');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('passports', function (Blueprint $table) {
			//
		});
	}
}
