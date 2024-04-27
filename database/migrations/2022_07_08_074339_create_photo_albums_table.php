<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoAlbumsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photo_albums', function (Blueprint $table) {
			$table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->date('photo_album_date')->comment('Дата створення фотоальбому');
			$table->string('photo_album_name')->comment('Назва фотоальбому');
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
		Schema::dropIfExists('photo_albums');
	}
}
