<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Получаем заказы пользователя вместе с элементами заказа
        $orders = Order::where('id_user', $user->id)
            ->with('items')
            ->orderBy('order_date', 'desc')
            ->get();

        return view('profile.profile', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидируем и обновляем данные
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:30',
            'middle_name' => 'nullable|string|max:30',
            'phone' => 'required|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile/profile.show')->with('status', 'Данные успешно обновлены');
    }

    public function orders()
    {
        $user = Auth::user();

        // Получаем заказы пользователя вместе с элементами заказа
        $orders = Order::where('id_user', $user->id)
            ->with('items')
            ->orderBy('order_date', 'desc')
            ->get();

        return view('profile.orders', compact('user', 'orders'));
    }
}
