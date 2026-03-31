<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'categories_products';

    protected $fillable = [
        'name',
        'parent_id',
        'show',
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
