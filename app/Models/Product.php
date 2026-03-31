<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','description','price','user_id','image'];
    
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}
