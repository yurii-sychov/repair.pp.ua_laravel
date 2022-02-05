<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiphersTechnicsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::dropIfExists('ciphers_technics');
		Schema::create('ciphers_technics', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('cipher_id')->index()->comment('Шифр');
			$table->integer('technic_id')->index()->comment('Техніка');
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
		Schema::dropIfExists('ciphers_technics');
	}
}
