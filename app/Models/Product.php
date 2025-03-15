<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';

    // Указываем имя таблицы, с которой связана модель
    protected $table = 'products';

    // Определяем поля, которые можно массово заполнять (mass assignable)
    protected $fillable = [
        'name_product', 
        'description',  
        'picture',      
        'price',        
        'kol',          
        'id_category',  
    ];

    // Указываем, как приводить поля к определённым типам данных
    protected $casts = [
        'price' => 'decimal:2', // Приводим цену к типу decimal с двумя знаками после запятой
        'kol' => 'integer',     // Приводим количество к целочисленному типу
    ];

    /**
     * Связь с категорией продукта.
     * Это отношение "многие к одному" (belongsTo), где продукт принадлежит категории.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    /**
     * Связь с `OrderItem`, чтобы получить заказы, связанные с продуктом.
     * Это отношение "один ко многим" (hasMany), где один продукт может быть в нескольких заказах.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_product', 'id_product');
    }
}
