<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    // Выполняет миграцию для создания таблицы "products".
    public function up()
    {
        // Создание таблицы "products"
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name_product', 100);
            $table->text('description')->nullable();
            $table->string('picture')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('kol');
            $table->unsignedBigInteger('id_category')->nullable(); // (внешний ключ)
            // Устанавливаем связь с таблицей "categories" (при удалении категории устанавливается NULL)
            $table->foreign('id_category')->references('id_category')->on('categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    // Откатывает миграцию, удаляя таблицу "products".
    public function down()
    {
        // Удаление таблицы "products", если она существует
        Schema::dropIfExists('products');
    }
}