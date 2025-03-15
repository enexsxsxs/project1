<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //Отображает панель администратора.
    public function index()
    {
        return view('admin.dashboard');
    }

    // Отображает список всех пользователей.
    public function users()
    {
        $users = User::all(); // Получаем всех пользователей
        return view('admin.users', compact('users'));
    }

    //Удаляет пользователя по его ID.
    public function deleteUser($id)
    {
        $user = User::find($id); // Находим пользователя по ID

        // Проверяем, является ли пользователь администратором
        if ($user->role == 1) {
            return redirect()->route('admin.users')->with('error', 'Нельзя удалить администратора.');
        }

        $user->delete(); // Удаляем пользователя
        return redirect()->route('admin.users')->with('success', 'Пользователь удален.');
    }

    //Отображает список всех продуктов, сгруппированных по категориям.
    public function products()
    {
        $categories = Category::all(); // Получаем все категории
        $productsByCategory = [];
    
        foreach ($categories as $category) {
            // Получаем продукты для каждой категории
            $productsByCategory[$category->id_category] = $category->products;
        }
    
        return view('admin.products', compact('categories', 'productsByCategory'));
    }
    
    //Отображает форму для создания нового продукта.
    public function createProduct()
    {
        $categories = Category::all(); // Получаем все категории
        return view('admin.create_product', compact('categories'));
    }

    //Сохраняет новый продукт в базу данных.
    public function storeProduct(Request $request)
    {
        // Валидация данных из формы
        $request->validate([
            'name_product' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'kol' => 'required|integer',
            'id_category' => 'required|integer',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Загрузка изображения и сохранение его пути
        $path = '/storage/' . $request->file('picture')->store('products', 'public');

        // Создание нового продукта
        $product = Product::create([
            'name_product' => $request->name_product,
            'description' => $request->description,
            'price' => $request->price,
            'kol' => $request->kol,
            'id_category' => $request->id_category,
            'picture' => $path,
        ]);

        return redirect()->route('admin.products')->with('success', 'Продукт добавлен.');
    }

    // Отображает форму для редактирования продукта.
    public function editProduct($id)
    {
        $product = Product::find($id); // Находим продукт по ID
        $categories = Category::all(); // Получаем все категории
        return view('admin.edit_product', compact('product', 'categories'));
    }

    //Обновляет данные продукта в базе данных.
    public function updateProduct(Request $request, $id)
    {
        // Валидация данных из формы
        $request->validate([
            'name_product' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'kol' => 'required|integer',
            'id_category' => 'required|integer',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::find($id); // Находим продукт по ID

        // Если загружено новое изображение, удаляем старое и сохраняем новое
        if ($request->hasFile('picture')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->picture));
            $path = $request->file('picture')->store('products', 'public');
            $product->picture = $path;
        }

        // Обновляем данные продукта
        $product->update([
            'name_product' => $request->name_product,
            'description' => $request->description,
            'price' => $request->price,
            'kol' => $request->kol,
            'id_category' => $request->id_category,
        ]);

        return redirect()->route('admin.products')->with('success', 'Продукт обновлен.');
    }

    //Удаляет продукт по его ID.
    public function deleteProduct($id)
    {
        $product = Product::find($id); // Находим продукт по ID
        Storage::disk('public')->delete($product->picture); // Удаляем изображение продукта
        $product->delete(); // Удаляем продукт
        return redirect()->route('admin.products')->with('success', 'Продукт удален.');
    }

    //Отображает список всех заказов.
    public function orders()
    {
        $orders = Order::with('user')->get(); // Получаем все заказы с информацией о пользователях
        return view('admin.orders', compact('orders'));
    }

    // Обновляет данные заказа в базе данных.
    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id); // Находим заказ по ID
        $order->update($request->all()); // Обновляем данные заказа
        return redirect()->route('admin.orders')->with('success', 'Заказ обновлен.');
    }

    //Отображает список всех категорий.
    public function categories()
    {
        $categories = Category::all(); // Получаем все категории
        return view('admin.categories', compact('categories'));
    }

    //Отображает форму для создания новой категории.
    public function createCategory()
    {
        return view('admin.create_category');
    }

    //Сохраняет новую категорию в базу данных.
    public function storeCategory(Request $request)
    {
        // Валидация данных из формы
        $request->validate([
            'name_category' => 'required|string|max:100',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $picturePath = null;
    
        // Если загружено изображение, сохраняем его путь
        if ($request->hasFile('picture')) {
            $picturePath = '/storage/' . $request->file('picture')->store('categories', 'public');
        }
    
        // Создание новой категории
        Category::create([
            'name_category' => $request->name_category,
            'picture' => $picturePath,
        ]);
    
        return redirect()->route('admin.categories')->with('success', 'Категория добавлена.');
    }

    // Удаляет категорию по её ID.
    public function deleteCategory($id)
    {
        $category = Category::find($id); // Находим категорию по ID
        $category->delete(); // Удаляем категорию
        return redirect()->route('admin.categories')->with('success', 'Категория удалена.');
    }
}