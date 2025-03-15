@extends('layouts.app')

@section('title', 'История заказов')

@section('content')
    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="container">
            <div class="order-history">
                <h3>История заказов</h3>
                @forelse($orders as $order)
                    <div class="order-item">
                        <h5>Заказ #{{ $order->id_order }}</h5>
                        <p>Дата заказа: {{ $order->order_date->format('d.m.Y H:i') }}</p>
                        <p>Статус: <span class="badge">{{ $order->status }}</span></p>
                        <p>Сумма: {{ number_format($order->summ, 2) }} ₽</p>
                        <ul>
                            @foreach($order->items as $item)
                                <li>
                                    <span>{{ $loop->iteration }}. {{ $item->product->name_product ?? 'Неизвестный товар' }}</span>
                                    <span class="item-total">{{ $item->kol }} шт × {{ number_format($item->price, 2) }} ₽ = {{ number_format($item->kol * $item->price, 2) }} ₽</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="no-orders">У вас пока нет заказов.</p>
                @endforelse
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #CDD8FF;
            font-family: "Playfair Display", serif;
            font-weight: 600;
            color: #333;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #CDD8FF;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #B0C4DE;
            border-bottom: 1px solid #9FB6CD;
            padding: 10px 15px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .form-control {
        border: 1px solid #B0C4DE;
        }

        .form-control:focus {
            border-color: #9FB6CD;
            box-shadow: 0 0 0 0.2rem rgba(159, 182, 205, 0.25);
        }

        .btn {
            border-radius: 5px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color: #9FB6CD;
            border-color: #9FB6CD;
        }

        .btn-secondary {
            background-color: #B0C4DE;
            border-color: #B0C4DE;
        }

        .btn-success {
            background-color: #90EE90;
            border-color: #90EE90;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
        }

        .bg-info {
            background-color: #B0E0E6 !important;
        }

        .alert-success {
            background-color: #90EE90;
            border-color: #98FB98;
            color: #006400;
        }

        .border-bottom {
            border-bottom: 1px solid #B0C4DE !important;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        .invalid-feedback {
            color: #DC143C;
        }
      
        .order-history {
            background-color: #F0F4FF;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-history h3 {
            color: #4A5568;
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #CDD8FF;
            padding-bottom: 10px;
        }

        .order-item {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .order-item h5 {
            color: #2D3748;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .order-item p {
            color: #4A5568;
            margin-bottom: 5px;
        }

        .order-item .badge {
            background-color: #CDD8FF;
            color: #4A5568;
            font-weight: normal;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .order-item ul {
            list-style-type: none;
            padding-left: 0;
            margin-top: 10px;
        }

        .order-item li {
            background-color: #F7FAFF;
            border-radius: 5px;
            padding: 8px 12px;
            margin-bottom: 5px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-item li span {
            color: #4A5568;
        }

        .order-item li .item-total {
            font-weight: bold;
            color: #2D3748;
        }

        .no-orders {
            color: #718096;
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .order-history {
                padding: 15px;
            }

            .order-item {
                padding: 12px;
            }

            .order-item li {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-item li .item-total {
                margin-top: 5px;
            }
        }
    </style>
@endsection
