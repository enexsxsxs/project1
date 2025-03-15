@extends('layouts.app')

@section('title', 'Результаты поиска для ' . $query)

@section('content')
    <h1>Результаты поиска для <u><b>{{ $query }}</b></u></h1>

    @if($products->isEmpty())
        <p>Ничего не найдено :(</p>
    @else
        <div class="product-list">
            @foreach($products as $product)
                <a href="{{ route('products.showProduct', $product->id_product) }}" class="product-card" style="text-decoration: none; color: inherit; margin-bottom: 15px;">
                    <div class="product-card-content" style="display: flex; align-items: center; border-bottom: 1px solid #ddd; padding: 10px 0;">
                        <!-- Изображение -->
                        <img src="{{ asset($product->picture) }}" alt="{{ $product->name_product }}" class="product-image" style="width: 100px; height: 100px; object-fit: contain; margin-right: 20px;">
                        <!-- Текстовая информация -->
                        <div class="product-info" style="flex: 1;">
                            <h5 class="product-name" style="font-size: 16px; margin-bottom: 5px;">{{ $product->name_product }}</h5>
                            <p class="product-description" style="font-size: 14px; color: #555; margin-bottom: 5px;">{{ Str::limit($product->description, 100) }}</p>
                        </div>

                        <!-- Цена -->
                        <div class="product-price" style="font-size: 14px; font-weight: bold; color: #333;">
                            {{ $product->price }} ₽
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection