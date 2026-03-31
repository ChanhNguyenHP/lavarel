<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'total_amount',
        'status',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
