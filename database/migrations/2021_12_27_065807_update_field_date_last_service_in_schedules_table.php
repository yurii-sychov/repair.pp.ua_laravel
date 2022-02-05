<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldDateLastServiceInSchedulesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schedules', function (Blueprint $table) {
			if (Schema::hasColumn('schedules', 'date_last_service')) {
				$table->dropColumn('date_last_service');
			}
			$table->year('year_last_service')->nullable()->after('periodicity')->comment('Рік останього ремонту');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schedules', function (Blueprint $table) {
			//
		});
	}
}
