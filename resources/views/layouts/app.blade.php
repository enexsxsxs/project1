<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Enexs Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link type="image/x-icon" href="{{ asset('favicon.ico') }}" rel="icon">

    <style>
        body {
            font-family: 'Playfair Display', serif;
            background-color: #CDD8FF;
        }

        header {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .hader-bg {
            background-color: #8BA3F4;
            color: white;
            border-radius: 15px;
            padding: 10px;
            margin: 10px;
        }
        .hader-bg .nav-link {
            font-family: "Playfair Display", serif;
            font-weight: 400;
            color: white;
        }

        .search-input {
            border-radius: 20px; /* Скругление */
            padding-right: 2.5rem; /* Отступ справа для иконки */
            padding-left: 2.5rem; /* Отступ слева для иконки */
            background-color: rgba(255, 255, 255, 0.8); /* Прозрачность фона */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Плавные переходы */
        }

        .btn {
        display: inline-block;
        font-weight: 400;
        color: #212529;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        background-color: transparent;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        color: #fff;
        background-color: #c82333;
        border-color: #bd2130;
    }


        /* Иконка поиска */
        .search-icon {
            position: absolute;
            left: 15px; /* Отступ для иконки */
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Цвет текста плейсхолдера */
            .search-input::placeholder {
        }

        /* Эффект при наведении */
        .search-input:hover, .search-input:focus {
            background-color: rgba(255, 255, 255, 1); /* Убираем прозрачность при наведении */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Тень при наведении */
        }
        .collapse {
    transition: height 0.3s ease-out;
        }

        .catalog-menu {
            background-color: #8BA3F4; /* Цвет фона совпадает с шапкой */
            padding: 10px;
            border-radius: 0 0 15px 15px; /* Скругленные углы снизу */
        }

        .catalog {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0;
            width: 100%;
            background-color: #8BA3F4; /* Цвет фона каталога */
            padding: 20px;
            border-top: 2px solid #8BA3F4;
        }

        .catalog-menu .category-card h3 {
            color: black; /* Названия категорий черным цветом */
        }

        .category-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            text-align: center;
            width: 150px;
            transition: transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .category-card img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .category-card h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        footer {
            background-color: #8BA3F4;
            color: black;
            padding: 10px 0;
            margin-top: auto;
            line-height: 1.2;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-section {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex: 1;
        }

        .footer-nav ul li {
            margin-bottom: 25px;
            font-size: 18px;
        }

        .footer-nav ul li a {
            color: black;
            text-decoration: none;
        }

        footer a {
            text-decoration: none;
            color: black;
        }

        .footer-contact {
            font-family: "Playfair Display", serif;
            font-weight: 400;
            font-size: 20px;
        }

        .footer-disclaimer {
            font-family: "Playfair Display", serif;
            font-weight: 600;
            max-width: 600px;
            font-size: 24px;
        }

        .footer-nav ul li a:hover {
            text-decoration: none;
        }


        .cart-indicator {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            font-size: 14px; /* Размер шрифта */
            font-weight: bold;
            padding: 4px; /* Отступы внутри круга */
            border-radius: 50%; /* Делает элемент круглым */
            line-height: 1; /* Центрирование текста по вертикали */
            width: 24px; /* Фиксированная ширина */
            height: 24px; /* Фиксированная высота */
            text-align: center; /* Центрирование текста по горизонтали */
            display: flex;
            justify-content: center; /* Центрирование контента по горизонтали */
            align-items: center; /* Центрирование контента по вертикали */
            min-width: 24px; /* Гарантирует, что индикатор будет хотя бы 24px по ширине */
        }
        
        .catalog-menu {
            margin-top: -20px; /* Уменьшите отступ сверху */
        }

    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<header>

    <div class="navbar-wrapper">
        <nav class="navbar navbar-expand-lg hader-bg position-relative">
            <div class="container-fluid">
                <a class="piccher me-4" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Логотип" class="me-2" style="max-width: 100px;">
                </a>

                <!-- Кнопка Каталог -->
                <button class="btn btn-light me-1" type="button" data-bs-toggle="collapse" data-bs-target="#catalogMenu">
                    Каталог
                </button>

                <form action="{{ route('search') }}" method="get" class="position-relative w-50">
                    <input type="text" name="query" class="form-control search-input" placeholder="Поиск..." aria-label="Search" value="{{ request()->query('query') }}">
                    <i class="fas fa-search search-icon"></i>
                </form>


                <!-- Ссылка на корзину с иконкой и индикатором количества товаров -->
                <a href="/cart" class="btn btn-outline-primary rounded-circle me-1" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; position: relative;">
                    <i class="fas fa-shopping-cart"></i>

                    <!-- Проверка наличия товаров в корзине -->
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <!-- Индикатор количества товаров в корзине -->
                        <span class="cart-indicator">
                            {{ array_sum(array_column(session('cart'), 'quantity')) }}
                        </span>
                    @endif
                </a>

                <a href="/about" class="btn btn-light me-1">О нас</a>

                <div class="dropdown">
                    <!-- Кнопка для открытия выпадающего меню профиля -->
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> <!-- Иконка пользователя -->
                    </button>

                    <!-- Выпадающее меню -->
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- Если пользователь авторизован -->
                        @if(Auth::check())
                            <li><a class="dropdown-item" href="/profile">Мои данные</a></li>
                            <li><a class="dropdown-item" href="/profile/orders">Мои заказы</a></li>
                            <li>
                                <!-- Форма для выхода из системы -->
                                <form action="/logout" method="POST" style="display: inline;">
                                    @csrf <!-- CSRF-токен для защиты от атак -->
                                    <button type="submit" class="dropdown-item">Выйти</button>
                                </form>
                            </li>
                        @else
                            <!-- Если пользователь не авторизован -->
                            <li><a class="dropdown-item" href="/login">Вход</a></li>
                            <li><a class="dropdown-item" href="/register">Регистрация</a></li> 
                        @endif
                    </ul>
                </div>

                <!-- Добавление ссылки на админ панель для администратора -->
                @if(Auth::check() && Auth::user()->role == 1)
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light me-1">Админ панель</a>
                @endif
                </div>
                </nav>

                <!-- Выпадающее меню каталога -->
                <div class="collapse position-absolute w-100" id="catalogMenu" style="z-index: 1050;">
                    <div class="catalog-menu hader-bg rounded-top">
                        <div class="catalog d-flex flex-wrap justify-content-around">
                            @foreach($categories as $category)
                                <div class="category-card">
                                    <a href="{{ url('/products/category/' . $category->id_category) }}">
                                        <img src="{{ asset($category->picture) }}" alt="{{ $category->name_category }}">
                                    </a>
                                    <h3>{{ $category->name_category }}</h3>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


</header>

@if (session('success'))
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
            </div>
        </div>
    </div>
@endif

<main class="container my-4">
    @yield('content')
</main>

<footer>
    <div class="footer-container d-flex justify-content-center align-items-center">
        <div class="footer-section d-flex justify-content-center align-items-center">
            <ul class="list-unstyled">
                <li><a href="{{ url('/') }}">Главная</a></li>
                <li>
                    <a href="#"
                       class="nav-link"
                       data-bs-toggle="collapse"
                       data-bs-target="#catalogMenu"
                       aria-expanded="false"
                       aria-controls="catalogMenu"
                       onclick="scrollToTop()">
                        Каталог
                    </a>
                </li>
                <li><a href="{{ url('/about') }}">О Нас</a></li>
                <li><a href="{{ url('/help') }}">HELP</a></li>
            </ul>
        </div>

        <div class="footer-section d-flex justify-content-center align-items-center">
            <div class="footer-contact">
                <p><a href="tel:+79000000000" style="color: white;"><i class="fas fa-phone"></i> +7 (900) 000-00-00</a></p>
                <p><a href="mailto:info@enexs.shop" style="color: white;"><i class="fas fa-envelope"></i> info@enexsshop.ru</a></p>
                <p><i class="fas fa-map-marker-alt"></i> г. Иркутск, ул. Пришвинская, д. 1</p>
            </div>
        </div>

        <div class="footer-section d-flex justify-content-center align-items-center">
            <div class="footer-disclaimer">
                <p>Данный интернет-сайт предоставляет информацию о товарах, но не является публичной офертой согласно статье 437 ГК РФ. Товар может не приехать! 😊</p>
            </div>
        </div>
    </div>
</footer>


<<!-- Подключение библиотеки Bootstrap для работы с JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Когда страница полностью загружена, выполняем следующий код
    document.addEventListener('DOMContentLoaded', function () {
        // Находим все элементы с классом "toast" (например, уведомления)
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));

        // Для каждого найденного элемента "toast"
        toastElList.forEach(function (toastEl) {
            // Создаем объект уведомления с использованием Bootstrap
            var toast = new bootstrap.Toast(toastEl);
            // Показываем уведомление
            toast.show();
        });
    });
</script>

<script>
    // Когда страница полностью загружена, выполняем следующий код
    document.addEventListener('DOMContentLoaded', function () {
        // Получаем количество товаров в корзине из локального хранилища (например, localStorage)
        var cartCount = localStorage.getItem('cartCount') || 0;
        // Находим элемент, который отображает количество товаров в корзине
        var cartIndicator = document.getElementById('cart-indicator');

        // Если количество товаров больше 0
        if (cartCount > 0) {
            // Обновляем текст индикатора, чтобы показать количество товаров
            cartIndicator.textContent = cartCount;
            // Показываем индикатор
            cartIndicator.style.display = 'inline-block';
        } else {
            // Если корзина пуста, скрываем индикатор
            cartIndicator.style.display = 'none';
        }
    });

    // Функция для плавного прокручивания страницы вверх
    function scrollToTop() {
        // Прокручиваем страницу вверх с плавным эффектом
        window.scrollTo({
            top: 0, // Верх страницы
            behavior: 'smooth' // Плавный скролл
        });
    }
</script>

</body>
</html>
