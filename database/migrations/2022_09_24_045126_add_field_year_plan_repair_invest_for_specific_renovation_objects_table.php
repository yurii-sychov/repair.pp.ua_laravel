<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldYearPlanRepairInvestForSpecificRenovationObjectsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('specific_renovation_objects', function (Blueprint $table) {
			$table->year('year_plan_repair_invest')->comment('Плановий рік заходу з ремонту по ІП')->nullable()->after('year_repair_invest');
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
