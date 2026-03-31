<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function saveOrder(Request $request, $user_id)
    { 
        if (!User::where('id', $user_id)->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'order_code' => 'DH_KH_' . time(),
            'status' => 'pending',
            'total_amount' => 0,
            'user_id' => $user_id,
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $product = Product::where('id', $item['product_id'])
                    ->where('user_id', $user_id)
                    ->first();
            $itemTotal = $product->price * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'total_price' => $itemTotal,
            ]);

            $total += $itemTotal;
        }

        $order->update(['total_amount' => $total]);

        return response()->json($order->load('items'), 201);
    }
}
