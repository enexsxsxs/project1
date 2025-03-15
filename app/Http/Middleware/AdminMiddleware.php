<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Обработка входящего запроса.
     * Этот middleware проверяет, является ли пользователь администратором.
     * Если пользователь не авторизован или не является администратором, он будет перенаправлен на главную страницу с сообщением об ошибке.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
    }
}