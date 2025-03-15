@extends('layouts.app') 

@section('title', 'Главная')

@section('content')
<style>
    .main-content {
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 100px 20px;
    }
    .product-image {
        margin-top: 110px;
        margin-left: -150px;
    }
    .product-text {
        font-family: "Playfair Display", serif;
        font-weight: 700;
        font-size: 64px;
        text-align: right;
        margin-right: -150px;
    }
    .otdel {
        color: #3A314E; 
    }
</style>
<main class="main-content">
    <img src="{{ asset('images/kla_&_mish.png') }}" alt="Клавиатура и мышь" class="product-image">
    <div class="product-text">
        Легко выбирайте <span class="otdel"> периферию,</span> которая подходит именно вам
    </div>
</main>

@endsection