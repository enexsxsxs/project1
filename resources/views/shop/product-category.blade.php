@extends('layouts.app')

@section('title', $categoryName)

@section('content')
    <div class="container">
        @if ($products->isEmpty())
            <p>Продукты не найдены.</p>
        @else
            <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
                @foreach ($products as $product)
                    <a href="{{ $product->kol > 0 ? route('products.showProduct', $product->id_product) : '#' }}" class="product-card {{ $product->kol == 0 ? 'disabled' : '' }}">
                        <h2>{{ $product->name_product }}</h2>
                        @if ($product->picture)
                        <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}">
                        @endif
                        <p>Цена: <strong>{{ $product->price }} руб.</strong></p>
                        @if ($product->kol == 0)
                            <p class="text-danger">Товар недоступен</p>
                        @else
                            <form action="{{ route('cart.add') }}" method="POST" style="text-align: center;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id_product }}">
                                <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                            </form>
                        @endif
                    </a>
                @endforeach
            </div>

            {{ $products->links() }}
        @endif
    </div>

    <style>
        .product-card {
            text-decoration: none;
            color: inherit;
            display: block;
            width: 200px;
            height: 350px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            overflow: hidden;
            position: relative;
            background: white;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .product-card:hover {
            animation: rainbow-border 2s linear infinite;
            background: white;
        }

        @keyframes rainbow-border {
            0% {
                box-shadow: 0 0 5px 2px red;
            }
            25% {
                box-shadow: 0 0 5px 2px orange;
            }
            50% {
                box-shadow: 0 0 5px 2px yellow;
            }
            75% {
                box-shadow: 0 0 5px 2px green;
            }
            100% {
                box-shadow: 0 0 5px 2px blue;
            }
        }

        .product-card img {
            max-width: 100%;
            max-height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-card h2 {
            font-size: 16px;
            line-height: 1.4;
            max-height: 3em;
            overflow: hidden;
            word-wrap: break-word;
            text-align: center;
            width: 100%;
        }

        .product-card p {
            margin: 10px 0;
            text-align: center;
        }

        .text-danger {
            color: red;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
@endsection