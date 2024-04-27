<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassportPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passport_photos', function (Blueprint $table) {
            $table->charset = 'utf8';
			$table->collation = 'utf8_general_ci';
			$table->integer('id')->autoIncrement()->comment('ID');
			$table->integer('passport_id')->index()->comment('Паспорт');
			$table->string('photo', 40)->comment('Фото');
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
        Schema::dropIfExists('passport_photos');
    }
}
