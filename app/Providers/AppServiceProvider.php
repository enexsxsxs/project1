<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    // Регистрация любых сервисов приложения.
    public function register(): void
    {
        //
    }

    // Загрузка любых сервисов приложения.
    public function boot(): void
    {
        // Используем View Composer для того, чтобы передать данные во все шаблоны
        View::composer('*', function ($view) {
            // Загружаем все категории из базы данных
            $categories = Category::all();

            // Передаем категории в шаблоны, чтобы они были доступны во всех представлениях
            $view->with('categories', $categories);
        });
    }
}