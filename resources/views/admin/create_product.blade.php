@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить продукт</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name_product">Название</label>
            <input type="text" name="name_product" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Цена</label>
            <input type="text" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kol">Количество</label>
            <input type="number" name="kol" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_category">Категория</label>
            <select name="id_category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Фото</label>
            <input type="file" name="picture" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
@endsection