@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
<style>
       
        .catalog {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 70px;
            margin-left: 130px;
            width: 80%;
            max-width: 1100px;
            background-color: #9BAEEF;
            border-radius: 20px;
            padding: 100px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.1);
        }
        .category-card {
            background-color: #F0F0F0;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            width: 250px;
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-10px);
        }
        .category-card img {
            margin-left: -25px;
            width: 250px;
            height: 230px;
            object-fit: contain;
            margin-bottom: 10px;
        }
        .category-card h3 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
        }
    </style>
@endsection
