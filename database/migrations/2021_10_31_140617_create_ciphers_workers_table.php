<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiphersWorkersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::dropIfExists('ciphers_workers');
		Schema::create('ciphers_workers', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('cipher_id')->index()->comment('Шифр');
			$table->integer('worker_id')->index()->comment('Ресурс');
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
		Schema::dropIfExists('ciphers_workers');
	}
}
