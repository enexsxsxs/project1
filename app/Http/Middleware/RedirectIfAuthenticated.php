<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, $guard = null)
    {
        // Проверяем, авторизован ли пользователь с использованием указанного guard (или guard по умолчанию)
        if (Auth::guard($guard)->check()) {
            // Если пользователь авторизован, перенаправляем его на главную страницу
            return redirect('/');
        }

        return $next($request);
    }
}