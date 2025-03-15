@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Продукты</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Добавить продукт</a>

    <!-- Вкладки категорий -->
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        @foreach($categories as $category)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($loop->first) active @endif" id="tab-{{ $category->id_category }}" data-bs-toggle="tab" href="#category-{{ $category->id_category }}" role="tab" aria-controls="category-{{ $category->id_category }}" aria-selected="true">
                    {{ $category->name_category }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Контент вкладок -->
    <div class="tab-content" id="productTabsContent">
        @foreach($categories as $category)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="category-{{ $category->id_category }}" role="tabpanel" aria-labelledby="tab-{{ $category->id_category }}">
                @if(isset($productsByCategory[$category->id_category]) && count($productsByCategory[$category->id_category]) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Цена</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productsByCategory[$category->id_category] as $product)
                                <tr>
                                    <td>{{ $product->id_product }}</td>
                                    <td>{{ $product->name_product }}</td>
                                    <td>
                                        <div class="description-container" id="description-container-{{ $product->id_product }}">
                                            <div class="description-text" id="description-text-{{ $product->id_product }}">
                                                {{ $product->description }}
                                            </div>
                                            <button type="button" class="btn btn-link toggle-description" data-product-id="{{ $product->id_product }}" style="display: none;">Развернуть</button>
                                        </div>
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id_product) }}" class="btn btn-primary">Редактировать</a>
                                        <form action="{{ route('admin.products.delete', $product->id_product) }}" method="POST" class="d-inline" onsubmit="return confirm('Вы уверены?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Нет продуктов в этой категории.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>

<style>
    body {
        background-color: #CDD8FF;
        font-family: "Playfair Display", serif;
        font-weight: 600;
        color: #333;
    }

    .nav-tabs .nav-link.active {
        background-color: #90EE90;
        color: #006400;
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

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem;
    }

    .alert-success {
        background-color: #90EE90;
        border-color: #98FB98;
        color: #006400;
    }

    .btn {
        display: inline-block;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: all 0.15s ease-in-out;
    }

    .btn-success {
        background-color: #90EE90;
        border-color: #90EE90;
        color: #006400;
    }

    .btn-success:hover {
        background-color: #7CCD7C;
        border-color: #7CCD7C;
    }

    .btn-primary {
        background-color: #9FB6CD;
        border-color: #9FB6CD;
        color: #333;
    }

    .btn-primary:hover {
        background-color: #8CA6C0;
        border-color: #8CA6C0;
    }

    .btn-danger {
        background-color: #FF6347;
        border-color: #FF6347;
        color: white;
    }

    .btn-danger:hover {
        background-color: #FF4500;
        border-color: #FF4500;
    }

    .mb-3 {
        margin-bottom: 1rem;
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
        vertical-align: top;
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

    .d-inline {
        display: inline-block;
    }

    .description-text {
        max-height: 3.6em; /* 2 строки текста */
        overflow: auto; /* Добавляем прокрутку */
        text-overflow: ellipsis;
    }

    .description-container {
        position: relative;
    }
</style>

@endsection