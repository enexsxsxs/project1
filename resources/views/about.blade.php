@extends('layouts.app')

@section('title', 'О нас')

@section('content')
    <div class="container">
        <div class="row align-items-center" style="min-height: 70vh;">
            <!-- Текстовый блок -->
            <div class="col-md-6 d-flex flex-column justify-content-center">
                <p style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 48px; text-align: left; margin-left: -150px; line-height: 1.2;">
                    Наша компания появилась на свет в 2024 году.
                </p>
                <p style="font-family: 'Playfair Display', serif; font-weight: 700; font-size: 32px; text-align: left; margin-left: -150px; line-height: 1.4;">
                    Основана на продаже периферийных устройств для компьютеров в Иркутске.
                </p>
                <p style="font-family: 'Playfair Display', serif; font-weight: 600; font-size: 32px; text-align: left; margin-left: -150px; line-height: 1.4;">
                    Мы выбираем лучшие кампании и тщательно контролируем каждый этап процесса сборки устройств.
                </p>
                <p style="font-family: 'Playfair Display', serif; font-weight: 400; font-size: 32px; text-align: left; margin-left: -150px; line-height: 1.4;">
                    Наш магазин поможет найти подходящее устройство для вашего компьютера.
                </p>
            </div>
            <!-- - col-md-6: Делает колонку шириной 50% на средних и больших экранах.
                - d-flex: Применяет гибкую раскладку для содержимого.
                - justify-content-center: Центрирует элементы по горизонтали.
                - align-items-center: Центрирует элементы по вертикали.-->
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/about.png') }}" alt="О нас" class="img-fluid rounded" style="border-radius: 10px; max-width: 70%;">
            </div>
        </div>
    </div>
@endsection

