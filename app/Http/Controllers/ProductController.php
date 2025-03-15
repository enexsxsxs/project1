<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Отображает страницу с категориями товаров.
    public function index()
    {
        // Получаем все категории из базы данных
        $categories = Category::all();

        // Возвращаем представление с категориями
        return view('shop.product', compact('categories'));
    }

    // Отображает товары для конкретной категории.
    public function showCategory($id)
    {
        // Проверяем, существует ли категория
        $category = Category::find($id);

        // Если категория не найдена, выбрасываем ошибку 404
        if (!$category) {
            abort(404, 'Категория не найдена.');
        }

        // Получаем товары для конкретной категории с пагинацией (по 10 товаров на странице)
        $products = Product::where('id_category', $id)->paginate(10);

        // Возвращаем представление с товарами и названием категории
        return view('shop.product-category', [
            'categoryName' => $category->name_category, 
            'products' => $products, 
        ]);
    }

    // Отображает детали конкретного товара.
    public function showProduct($id)
    {
        // Получаем товар по его ID. Если товар не найден, выбрасываем ошибку 404
        $product = Product::findOrFail($id);

        // Возвращаем представление с деталями товара
        return view('shop.product-detail', compact('product'));
    }
}