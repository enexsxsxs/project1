<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    //Обрабатывает поисковый запрос и возвращает результаты.
    public function search(Request $request)
    {
        // Получаем строку поискового запроса из запроса
        $query = $request->input('query');

        // Инициализируем переменную для хранения результатов поиска
        $products = null;

        // Если строка поиска не пуста, выполняем поиск
        if ($query) {
            // Ищем товары, у которых имя или описание содержат строку поиска
            $products = Product::where('name_product', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();
        }

        // Возвращаем представление с результатами поиска и строкой запроса
        return view('search.results', compact('products', 'query'));
    }
}