@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Заказы</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Дата заказа</th>
                <th>Сумма</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id_order }}</td>
                <td>{{ $order->user->last_name }} {{ $order->user->first_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->summ }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <form action="{{ route('admin.orders.update', $order->id_order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="Создан" {{ $order->status == 'Создан' ? 'selected' : '' }}>Создан</option>
                            <option value="В обработке" {{ $order->status == 'В обработке' ? 'selected' : '' }}>В обработке</option>
                            <option value="Сборка" {{ $order->status == 'Сборка' ? 'selected' : '' }}>Сборка</option>
                            <option value="Готов к выдаче" {{ $order->status == 'Готов к выдаче' ? 'selected' : '' }}>Готов к выдаче</option>
                            <option value="Завершён" {{ $order->status == 'Завершён' ? 'selected' : '' }}>Завершён</option>
                            <option value="Отменён" {{ $order->status == 'Отменён' ? 'selected' : '' }}>Отменён</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    body {
        background-color: #CDD8FF;
        font-family: "Playfair Display", serif;
        font-weight: 600;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #4A5568;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #333;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table th,
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #E2E8F0;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #E2E8F0;
        background-color: #F0F4FF;
        color: #4A5568;
        font-weight: 600;
    }

    .table tbody tr:nth-of-type(even) {
        background-color: #F7FAFF;
    }

    .table tbody tr:hover {
        background-color: #E6EFFF;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #9FB6CD;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(159, 182, 205, 0.25);
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .table, .table thead, .table tbody, .table tr, .table th, .table td {
            display: block;
        }

        .table tr {
            margin-bottom: 1rem;
            border: 1px solid #E2E8F0;
            border-radius: 0.375rem;
            overflow: hidden;
        }

        .table td {
            border: none;
            position: relative;
            padding-left: 50%;
        }

        .table td:before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: 600;
            color: #4A5568;
        }

        .form-control {
            width: 100%;
        }
    }
</style>
@endsection