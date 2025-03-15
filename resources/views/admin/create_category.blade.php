@extends('layouts.app')

@section('content')
<div class="container-wrapper">
    <div class="container1">
        <h1>Добавить категорию</h1>
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_category">Название</label>
                <input type="text" name="name_category" id="name_category" required>
            </div>
            <div class="form-group">
                <label for="picture">Картинка</label>
                <input type="file" name="picture" id="picture" accept="image/*">
            </div>
            <button type="submit">Добавить</button>
        </form>
    </div>
</div>
<style>
    body {
        font-family: 'Playfair Display', serif;
        background-color: #f5f5f5;
        color: #333;
    }

    .container-wrapper {
        display: flex;
        justify-content: center; /* Выравнивание по горизонтали */
        align-items: center; /* Выравнивание по вертикали */
        height: 50vh; /* Высота контейнера равна высоте видимой области */
    }

    .container1 {
        max-width: 600px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    h1 {
        font-size: 42px;
        color: #2c3e50;
        margin-bottom: 40px;
    }

    .form-group {
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }
</style>
@endsection