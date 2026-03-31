<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $orders = Order::with('items')->orderBy('id', 'desc');

        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->orderBy('id', 'desc');

        if ($request->has('status')) {
            $orders->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $orders->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $orders->whereDate('created_at', '<=', $request->to_date);
        }

        return response()->json($orders->get());
    }

    public function saveOrder(Request $request, $id = null)
    {
        if (!$id) {

            $request->validate([
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $order = Order::create([
                'order_code' => 'DH_' . time(),
                'status' => 'pending',
                'total_amount' => 0,
                'user_id' => Auth::id(),
            ]);

            $total = 0;

            foreach ($request->items as $item) {
                // $product = Product::find($item['product_id']);
                $product = Product::where('id', $item['product_id'])
                        ->where('user_id', Auth::id())
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

        // $order = Order::find($id);
        $order = Order::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($request->has('status') && !$request->has('items')) {
            $order->update(['status' => $request->status]);
            return response()->json($order);
        }

        if ($request->has('items')) {
            $request->validate([
                'items' => 'array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $order->items()->delete();

            $total = 0;

            foreach ($request->items as $item) {
                // $product = Product::find($item['product_id']);
                $product = Product::where('id', $item['product_id'])
                        ->where('user_id', Auth::id())
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

            $order->update([
                'total_amount' => $total,
                'status' => $request->status ?? $order->status
            ]);

            return response()->json($order->load('items'));
        }

        return response()->json(['message' => 'Nothing to update'], 400);
    }

    public function detailOrder($id)
    {
        // $order = Order::with('items')->find($id);
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('items')
            ->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json($order);
    }

    public function statisticsOrder(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date',
            'status'    => 'nullable|in:pending,processing,completed,cancelled'
        ]);

        // $query = Order::query();
        $query = Order::where('user_id', Auth::id());

        if ($request->from_date === $request->to_date) {
            $query->whereDate('created_at', $request->from_date);
        } else {
            $query->whereDate('created_at', '>=', $request->from_date)
                ->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalOrders = $query->count();
        $totalRevenue = $query->sum('total_amount');

        return response()->json([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'status' => $request->status ?? 'all',
            'total_orders' => $totalOrders,
            'total_revenue' => $totalRevenue
        ]);
    }

    public function destroy($id)
    {
        // $order = Order::find($id);
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($order->status === 'completed') {
            return response()->json([
                'message' => 'Completed orders cannot be deleted'
            ], 403);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }

}
