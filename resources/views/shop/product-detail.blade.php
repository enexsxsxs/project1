@extends('layouts.app')

@section('title', $product->name_product)

@section('content')
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                @if ($product->picture)
                    <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}" style="max-width: 100%; height: auto;">
                @endif
            </div>
            <div class="product-info">
                <h1>{{ $product->name_product }}</h1>
                <p><strong>Цена:</strong> {{ $product->price }} руб.</p>
                <p><strong>Описание:</strong> {{ $product->description }}</p>
                <p><strong>Количество в наличии:</strong> {{ $product->kol }}</p>
            </div>
        </div>
        <div class="buttons-container">

            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id_product }}">
                <button type="submit" id="add-to-cart-{{ $product->id_product }}" class="add-to-cart-btn" data-product-id="{{ $product->id_product }}">
                    Добавить в корзину
                </button>
            </form>
        </div>
    </div>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .product-details {
            display: flex;
            align-items: flex-start;
            width: 100%;
            margin-bottom: 20px;
        }

        .product-image {
            flex: 1;
            margin-right: 20px;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-info {
            flex: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-info h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-info p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
        }

        .back-button {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .back-button:hover {
            background: #0056b3;
        }

        .add-to-cart-form {
            display: inline-block;
        }

        .add-to-cart-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background: #218838;
        }
    </style>
@endsection