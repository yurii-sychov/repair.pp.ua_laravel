<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldYearRepairInvestForSpecificRenovationObjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('specific_renovation_objects', function (Blueprint $table) {
			$table->year('year_repair_invest')->comment('Рік заходу з ремонту по ІП')->nullable()->after('year_commissioning');
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
