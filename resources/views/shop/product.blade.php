@extends('layouts.app')

@section('title', $showCategories ? 'Категории товаров' : 'Мыши')

@section('content')
    <div class="container">
        @if ($showCategories)
            <h1>Категории товаров</h1>
            <ul>
            @foreach($categories as $category)
                    <li>{{ $category->name_category }}</li>
                @endforeach
            </ul>
        @else
            @if ($products->isEmpty())
                <p>Продукты не найдены.</p>
            @else
                <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
                    @foreach ($products as $product)
                        <a href="{{ route('products.showProduct', $product->id_product) }}" class="product-card">
                            <h2>{{ $product->name_product }}</h2>
                            @if ($product->picture)
                                <img src="{{ asset('storage' . $product->picture) }}" alt="{{ $product->name_product }}" style="max-width: 150px; height: auto;">
                            @endif
                            <p>Цена: <strong>{{ $product->price }} руб.</strong></p>
                        </a>

                        <form action="{{ route('cart.add') }}" method="POST" style="text-align: center;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id_product }}">
                        </form>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
