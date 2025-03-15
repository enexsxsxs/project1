<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_order';

    // Определяем поля, которые можно массово заполнять (mass assignable)
    protected $fillable = [
        'id_user',          
        'summ',             
        'status',           
        'payment_method',   
    ];

    // Определяем поля, которые должны быть автоматически преобразованы в объекты
    protected $dates = [
        'order_date',   
    ];

    /**
     * Аксессор для преобразования поля `order_date` в объект Carbon.
     * Это позволяет удобно работать с датой заказа, например, форматировать её или выполнять вычисления.
     */
    public function getOrderDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Связь с позициями заказа (OrderItem).
     * Это отношение "один ко многим" (hasMany), где один заказ может содержать несколько позиций.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_order', 'id_order');
    }

    /**
     * Связь с пользователем, который сделал заказ.
     * Это отношение "многие к одному" (belongsTo), где заказ принадлежит одному пользователю.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}