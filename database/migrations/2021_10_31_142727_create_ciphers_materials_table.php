<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiphersMaterialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::dropIfExists('ciphers_materials');
		Schema::create('ciphers_materials', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('cipher_id')->index()->comment('Шифр');
			$table->integer('material_id')->index()->comment('Матеріал');
			$table->tinyInteger('quantity')->comment('Кількість');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ciphers_materials');
	}
}
