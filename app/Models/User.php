<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'last_name',    
        'first_name',   
        'middle_name',  
        'phone',        
        'login',        
        'password',     
    ];

    // Определяем поля, которые должны быть скрыты при сериализации
    protected $hidden = [
        'password',     // Пароль пользователя не должен быть доступен в открытом виде
    ];
}