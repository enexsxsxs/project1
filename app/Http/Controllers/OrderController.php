<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; // Подключаем модель Product
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    // Метод для оформления заказа.
    public function placeOrder(Request $request)
    {
        // Проверяем, является ли пользователь администратором
        if (Auth::user()->role == 1) {
            return redirect()->route('profile/profile.show')->with('error', 'Администратор не может оформлять заказы.');
        }

        // Проверяем, есть ли товары в корзине
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Корзина пуста.');
        }

        // Создаем новый заказ
        $order = new Order();
        $order->id_user = Auth::id();
        $order->summ = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart)); 
        $order->status = 'Создан'; 
        $order->payment_method = $request->input('payment_method'); 
        $order->order_date = Carbon::now(); 
        $order->save(); 

        // Добавляем товары в заказ
        foreach ($cart as $productId => $item) {
            // Создаем запись о товаре в заказе
            OrderItem::create([
                'id_order' => $order->id_order, 
                'id_product' => $productId, 
                'kol' => $item['quantity'], 
                'price' => $item['price'], 
            ]);

            // Обновляем количество товара в таблице products
            $product = Product::find($productId);
            if ($product) {
                // Уменьшаем количество товара на количество, заказанное пользователем
                $product->kol -= $item['quantity'];
                $product->save(); // Сохраняем изменения
            }
        }

        // Очищаем корзину после оформления заказа
        session()->forget('cart');

        // Перенаправляем пользователя на страницу заказов с сообщением об успешном оформлении
        return redirect()->route('profile/orders.show')->with('success', 'Ваш заказ успешно оформлен!');
    }
}