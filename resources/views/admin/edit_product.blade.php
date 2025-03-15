@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать продукт</h1>
    <form action="{{ route('admin.products.update', $product->id_product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name_product">Название</label>
            <input type="text" name="name_product" class="form-control" value="{{ $product->name_product }}" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="kol">Количество</label>
            <input type="number" name="kol" class="form-control" value="{{ $product->kol }}" required>
        </div>
        <div class="form-group">
            <label for="id_category">Категория</label>
            <select name="id_category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}" {{ $category->id_category == $product->id_category ? 'selected' : '' }}>
                        {{ $category->name_category }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Фото</label>
            <input type="file" name="picture" class="form-control-file">
            @if($product->picture)
                <img src="{{ asset($product->picture) }}" alt="Фото продукта" style="max-width: 200px; margin-top: 10px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>
@endsection