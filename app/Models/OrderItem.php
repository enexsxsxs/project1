<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_order_item';

    // Определяем поля, которые можно массово заполнять (mass assignable)
    protected $fillable = [
        'id_order',     
        'id_product',   
        'kol',          
        'price',       
    ];

    /**
     * Связь с продуктом, который включён в заказ.
     * Это отношение "многие к одному" (belongsTo), где позиция заказа связана с одним продуктом.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}