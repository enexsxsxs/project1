<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Отображает форму входа.
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Обрабатывает запрос на вход в систему.
    public function login(Request $request)
    {
        // Валидация данных формы
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Если валидация не пройдена, возвращаем пользователя назад с ошибками и введенными данными
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Получаем данные для аутентификации
        $credentials = $request->only('login', 'password');

        // Проверяем, существует ли пользователь с указанным логином
        $userExists = User::where('login', $credentials['login'])->exists();
        if (!$userExists) {
            return back()->withErrors(['login' => 'Пользователь с таким логином не найден'])->withInput();
        }

        // Попытка аутентификации
        if (Auth::attempt($credentials)) {
            // Если аутентификация успешна, генерируем новую сессию
            $request->session()->regenerate();
            // Перенаправляем пользователя на запрашиваемую страницу или на главную
            return redirect()->intended('/');
        }

        // Если аутентификация не удалась, возвращаем пользователя назад с ошибкой
        return back()->withErrors(['password' => 'Неверный пароль'])->withInput();
    }

    // Обрабатывает запрос на выход из системы.
    public function logout(Request $request)
    {
        // Выход пользователя из системы
        Auth::logout();

        // Аннулируем текущую сессию
        $request->session()->invalidate();

        // Генерируем новый токен сессии для безопасности
        $request->session()->regenerateToken();

        // Перенаправляем пользователя на главную страницу
        return redirect('/');
    }
}