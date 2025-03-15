@extends('layouts.app') 

@section('title', 'Страница помощи')

@section('content')
<style>
    h1 {
        color: #007bff;
        text-align: center;
        margin-bottom: 30px;
    }
    p {
        line-height: 1.2;
        font-size: 24px;
    }
    .photo {
        margin: 40px 0;
        text-align: center;
    }
    .photo img {
        max-width: 60%; /* Уменьшаем ширину изображений */
        height: auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .photo img {
        max-width: 60%; /* Уменьшаем ширину изображений */
        height: auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .photo p {
        font-size: 18px;
        margin-bottom: 10px;
        color: #555;
    }
    code {
        background-color: #f1f1f1;
        padding: 2px 6px;
        border-radius: 4px;
        color: #d63384;
    }
</style>

<div class="container">
    <h1>Руководство пользователя</h1>

    <p>Для запуска веб-приложения в терминале выполните команду <code>php artisan serve</code>. Эта команда запустит локальный сервер Artisan, который будет доступен по адресу <code>http://localhost:8000</code>. Сервер Artisan автоматически загружает маршруты, контроллеры, модели и представления, что значительно упрощает процесс разработки и тестирования.</p>

    <p>После ввода адреса <code>http://localhost:8000</code> в браузере, отобразится главная страница. Это позволяет быстро оценить внешний вид и функциональность интерфейса.</p>

    <div class="photo">
        <p>ФОТО 1</p>
        <img src="/images/help/photo1.jpg" alt="Фото 1">
    </div>

    <p>Чтобы пользователь имел возможность добавлять в корзину, то нужно авторизоваться. Страница авторизации представлена на ФОТО 2.</p>

    <div class="photo">
        <p>ФОТО 2</p>
        <img src="/images/help/photo2.jpg" alt="Фото 2">
    </div>

    <p>Если у пользователя нет аккаунта, то ему нужно перейти на страницу регистрации (ФОТО 3).</p>

    <div class="photo">
        <p>ФОТО 3</p>
        <img src="/images/help/photo3.jpg" alt="Фото 3">
    </div>

    <p>После того, как пользователь зашёл в систему, то ему открывается возможность добавлять товары в корзину. На странице корзины пользователь может добавить количество товара, удалять добавленный товар и оформлять заказ. (ФОТО4)</p>

    <div class="photo">
        <p>ФОТО 4</p>
        <img src="/images/help/photo4.jpg" alt="Фото 4">
    </div>

    <p>Если пользователь нажмет на кнопку «Оформить заказ», то его перенаправит на страницу с историей его заказов. (ФОТО 5)</p>

    <div class="photo">
        <p>ФОТО 5</p>
        <img src="/images/help/photo5.jpg" alt="Фото 5">
    </div>

    <p>Так же пользователь может редактировать свои данные профиля. (ФОТО 6)</p>

    <div class="photo">
        <p>ФОТО 6</p>
        <img src="/images/help/photo6.jpg" alt="Фото 6">
    </div>

    <p>Также пользователь может просмотреть весь каталог товаров (ФОТО 7-8), страницу товаров (ФОТО 9). Эти товары можно добавить в корзину.</p>

    <div class="photo">
        <p>ФОТО 7</p>
        <img src="/images/help/photo7.jpg" alt="Фото 7">
    </div>

    <div class="photo">
        <p>ФОТО 8</p>
        <img src="/images/help/photo8.jpg" alt="Фото 8">
    </div>

    <div class="photo">
        <p>ФОТО 9</p>
        <img src="/images/help/photo9.jpg" alt="Фото 9">
    </div>
</div>
@endsection