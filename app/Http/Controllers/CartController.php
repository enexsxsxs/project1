<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    // Добавление товара в корзину.
    public function add(Request $request)
    {
        // Получаем ID товара и количество из запроса
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Проверяем, существует ли товар в базе данных
        $product = Product::findOrFail($productId);

        // Получаем доступное количество товара на складе
        $availableQuantity = $product->kol;

        // Проверяем, не превышает ли запрошенное количество доступное на складе
        if ($quantity > $availableQuantity) {
            return redirect()->back()->with('error', 'Недостаточно товара на складе');
        }

        // Получаем текущую корзину из сессии
        $cart = session()->get('cart', []);

        // Добавляем или обновляем товар в корзине
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name_product, 
                'price' => $product->price, 
                'quantity' => $quantity, 
                'picture' => $product->picture, 
                'kol' => $availableQuantity, 
            ];
        }

        // Сохраняем обновленную корзину в сессии
        session()->put('cart', $cart);

        // Перенаправляем пользователя обратно с сообщением об успешном добавлении
        return redirect()->back()->with('success', 'Товар "' . $product->name_product . '" добавлен в корзину');
    }

    //Просмотр содержимого корзины.
    public function view()
    {
        // Получаем корзину из сессии
        $cart = session()->get('cart', []);

        // Возвращаем представление с данными корзины
        return view('shop.cart', ['cart' => $cart]);
    }

    // Обновление количества товара в корзине.
    public function update(Request $request)
    {
        // Получаем ID товара и новое количество из запроса
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Получаем товар из базы данных
        $product = Product::find($productId);

        // Получаем доступное количество товара на складе
        $availableQuantity = $product->kol;

        // Получаем корзину из сессии
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Проверяем, не превышает ли новое количество доступное количество на складе
            if ($quantity > $availableQuantity) {
                return response()->json(['success' => false, 'message' => 'Недостаточно товара на складе']);
            }

            // Обновляем количество товара в корзине
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

            // Пересчитываем сумму для этого товара и общую сумму
            $item = $cart[$productId];
            $subtotal = $item['price'] * $item['quantity'];
            $total = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            // Возвращаем JSON с обновленными данными
            return response()->json([
                'success' => true,
                'subtotal' => number_format($subtotal, 0, ',', ' '),
                'total' => number_format($total, 0, ',', ' ')
            ]);
        }

        // Если товар не найден в корзине, возвращаем ошибку
        return response()->json(['success' => false, 'message' => 'Товар не найден в корзине']);
    }

    // Удаление товара из корзины.
    public function remove(Request $request)
    {
        // Получаем ID товара из запроса
        $productId = $request->input('product_id');

        // Удаляем товар из корзины
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        // Перенаправляем пользователя обратно с сообщением об успешном удалении
        return redirect()->back()->with('success', 'Товар удален из корзины!');
    }
}