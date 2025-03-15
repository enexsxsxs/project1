@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Админ Панель</h1>
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title text-dark">Пользователи</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.products') }}" class="text-decoration-none">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="fa fa-box fa-3x mb-3 text-success"></i>
                        <h5 class="card-title text-dark">Продукты</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.orders') }}" class="text-decoration-none">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="fa fa-shopping-cart fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title text-dark">Заказы</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.categories') }}" class="text-decoration-none">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="fa fa-tags fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title text-dark">Категории</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
