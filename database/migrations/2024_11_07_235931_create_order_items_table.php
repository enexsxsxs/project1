<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    //Выполняет миграцию для создания таблицы "order_items".
    public function up()
    {
        // Создание таблицы "order_items"
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('id_order_item');
            $table->unsignedBigInteger('id_order'); // (внешний ключ)
            $table->unsignedBigInteger('id_product'); // (внешний ключ)
            $table->integer('kol');
            $table->decimal('price', 10, 2);

            // Устанавливаем связь с таблицей "orders" (при удалении заказа удаляются все связанные записи)
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');

            // Устанавливаем связь с таблицей "products" (при удалении продукта удаляются все связанные записи)
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    // Откатывает миграцию, удаляя таблицу "order_items".
    public function down()
    {
        // Удаление таблицы "order_items", если она существует
        Schema::dropIfExists('order_items');
    }
}