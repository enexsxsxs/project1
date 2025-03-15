<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    //Выполняет миграцию для создания таблицы "orders".
    public function up()
    {
        // Создание таблицы "orders"
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_user'); // ID пользователя, связанного с заказом
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP')); // (по умолчанию текущее время)
            $table->decimal('summ', 10, 2);
            $table->enum('status', ['Создан', 'В обработке', 'Сборка', 'Готов к выдаче', 'Завершён', 'Отменён'])->default('Создан'); // (по умолчанию "Создан")
            $table->boolean('payment_method'); 

            // Устанавливаем связь с таблицей "users" (при удалении пользователя удаляются все связанные заказы)
            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    //Откатывает миграцию, удаляя таблицу "orders".
    public function down()
    {
        // Удаление таблицы "orders", если она существует
        Schema::dropIfExists('orders');
    }
}