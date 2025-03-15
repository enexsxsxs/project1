<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Отображает список всех категорий.
    public function index()
    {
        // Получаем все категории из базы данных
        $categories = Category::all();

        // Возвращаем представление с передачей данных о категориях
        return view('layouts.app', compact('categories'));
    }
}