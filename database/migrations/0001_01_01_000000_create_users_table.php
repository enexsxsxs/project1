<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Выполняет миграцию для создания таблиц в базе данных.
    public function up(): void
    {
        // Создание таблицы "users"
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 50); 
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable(); //(необязательное поле)
            $table->string('phone', 20)->unique(); 
            $table->string('login', 20)->unique(); // Логин (уникальное значение, максимум 20 символов)
            $table->string('password'); // Пароль (хэшированный)
            $table->tinyInteger('role')->default(0); // Роль пользователя (по умолчанию 0)
            $table->timestamps(); 
        });

        // Создание таблицы "sessions" для хранения сессий
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Уникальный идентификатор сессии
            $table->foreignId('user_id')->nullable()->index(); // Связь с таблицей "users"
            $table->string('ip_address', 45)->nullable(); // IP-адрес пользователя (максимум 45 символов)
            $table->text('user_agent')->nullable(); // Информация о браузере/устройстве пользователя
            $table->longText('payload'); // Данные сессии
            $table->integer('last_activity')->index(); // Время последней активности пользователя
        });
    }

    // Откатывает миграцию, удаляя созданные таблицы.
    public function down(): void
    {
        // Удаление таблицы "users", если она существует
        Schema::dropIfExists('users');

        // Удаление таблицы "sessions", если она существует
        Schema::dropIfExists('sessions');
    }
};