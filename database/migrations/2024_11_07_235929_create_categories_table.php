<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    // Выполняет миграцию для создания таблицы "categories".
    public function up()
    {
        // Создание таблицы "categories"
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('name_category', 100);
            $table->string('picture');
            $table->timestamps();
        });
    }

    // Откатывает миграцию, удаляя таблицу "categories".
    public function down()
    {
        // Удаление таблицы "categories", если она существует
        Schema::dropIfExists('categories');
    }
}