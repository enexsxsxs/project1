<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Отображает список продуктов в каталоге. Поддерживает поиск по имени или описанию продукта.
    public function index(Request $request)
    {
        // Получаем строку поиска из запроса
        $search = $request->input('search');

        // Если строка поиска присутствует, выполняем фильтрацию продуктов
        if ($search) {
            // Ищем продукты, у которых имя или описание содержат строку поиска
            $products = Product::where('name_product', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->get();
        } else {
            // Если строка поиска отсутствует, показываем все продукты
            $products = Product::all();
        }

        // Возвращаем представление с результатами поиска или полным списком продуктов
        return view('catalog.index', compact('products'));
    }
}