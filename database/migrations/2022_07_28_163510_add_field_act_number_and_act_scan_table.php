<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldActNumberAndActScanTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('operating_list_objects', function (Blueprint $table) {
			$table->string('document_number', 20)->comment('Номер документу')->after('service_date');
			$table->string('document_scan', 40)->comment('Скан документу')->after('executor');
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
