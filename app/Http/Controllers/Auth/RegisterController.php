<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    // Отображает форму регистрации.
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Обрабатывает запрос на регистрацию нового пользователя.
    public function register(Request $request)
    {
        // Валидация данных формы регистрации
        $request->validate([
            'last_name' => 'required|string|max:50', // Фамилия: обязательна, строка, максимум 50 символов
            'first_name' => 'required|string|max:50', // Имя: обязательно, строка, максимум 50 символов
            'middle_name' => 'nullable|string|max:50', 
            'phone' => 'required|string|max:20|unique:users,phone', // Телефон: обязателен, строка, максимум 20 символов, уникальный
            'login' => 'required|string|max:20|unique:users,login',
            'password' => 'required|string|min:8|confirmed', // Пароль: обязателен, строка, минимум 8 символов, подтверждение пароля
        ], [
            'phone.unique' => 'Номер телефона уже зарегистрирован',
            'login.unique' => 'Логин занят',
            'password.confirmed' => 'Введённые пароли не совпадают',
            'password.min' => 'Длина пароля не может быть меньше 8 символов',
        ]);

        // Создание нового пользователя в базе данных
        User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'phone' => $request->phone,
            'login' => $request->login, 
            'password' => Hash::make($request->password), // Пароль (хэшированный)
        ]);

        // Перенаправление на страницу входа с сообщением об успешной регистрации
        return redirect()->route('login')->with('status', 'Регистрация успешна!');
    }
}