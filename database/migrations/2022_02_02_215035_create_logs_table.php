<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::dropIfExists('logs');
		Schema::create('logs', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->integer('user_id')->index()->comment('Користувач');
			$table->string('link')->nullable()->comment('Посилання (сторінка)');
			$table->string('action', 50)->nullable()->comment('Повна назва дії');
			$table->enum('short_action', ['create', 'read', 'update', 'delete', 'unknown'])->nullable()->comment('Коротка назва дії');
			$table->string('data_before')->nullable()->comment('Дані до дії');
			$table->string('data_after')->nullable()->comment('Дані після дії');
			$table->string('browser', 10)->nullable()->comment('Браузер');
			$table->string('ip', 50)->nullable()->comment('IP адреса');
			$table->string('platform', 10)->nullable()->comment('Платформа');
			$table->integer('importance')->index()->comment('Важливість');
			$table->timestamp('created_at')->comment('Час створення запису');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('logs');
	}
}
