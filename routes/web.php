<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CategoryController;

// Маршруты для регистрации и авторизации (доступны только гостям)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Маршрут для выхода (доступен только авторизованным пользователям)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Маршруты для профиля (доступны только авторизованным пользователям)
Route::get('/profile', [ProfileController::class, 'show'])->name('profile/profile.show')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile/orders.show')->middleware('auth');

// Статические страницы
Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

// Публичные маршруты для поиска, продуктов и корзины
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{id_category}', [ProductController::class, 'showCategory']);
Route::get('/products/{id}', [ProductController::class, 'showProduct'])->name('products.showProduct');

Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Маршрут для оформления заказа
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

// Маршруты для администратора (доступны только администраторам)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard'); // Панель администратора
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users'); // Управление пользователями
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete'); // Удаление пользователя

    // Управление продуктами
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Управление заказами
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/orders/{id}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');

    // Управление категориями
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
});