<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $primaryKey = 'id_category'; 

    // Определяем поля, которые можно массово заполнять
    protected $fillable = [
        'name_category', 
        'picture',          
    ];

    /**
     * Связь с продуктами, принадлежащими данной категории.
     * Это отношение "один ко многим" (hasMany), где одна категория может содержать несколько продуктов.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}