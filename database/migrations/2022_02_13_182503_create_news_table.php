<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->string('title', 50)->nullable()->comment('Назва');
			$table->text('description')->nullable()->comment('Зміст новини');
			$table->integer('is_show')->index()->comment('Показувати');
			$table->string('text_color', 20)->nullable()->comment('Колір тексту');
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
		Schema::dropIfExists('news');
	}
}
