<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    // Form thêm
    public function create()
    {
        $products = Product::where('show', 1)->get();
        return view('admin.orders.create', compact('products'));
    }

    // Lưu đơn hàng
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = Order::create([
            'order_code' => 'ORD-'.time(),
            'total_amount' => 0,
            'status' => 'pending',
            'user_id' => 1,
        ]);

        $total = 0;

        foreach ($request->products as $item) {
            if (!isset($item['product_id']) || !isset($item['quantity'])) continue;

            $product = Product::find($item['product_id']);
            if (!$product) continue;

            $price = $product->price;
            $quantity = $item['quantity'];
            $total_price = $price * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'total_price' => $total_price,
            ]);

            $total += $total_price;
        }

        $order->update(['total_amount' => $total]);

        return response()->json([
            'status' => true,
            'order_code' => $order->order_code
        ]);
    }

    // Form sửa
    public function edit($id)
    {
        $orders = Order::with('items')->findOrFail($id);
        $productsOrder = OrderItem::where('order_id', $id)->get();
        return view('admin.orders.edit', compact('orders', 'productsOrder'));
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Xóa item cũ
        OrderItem::where('order_id', $order->id)->delete();

        $total = 0;

        foreach ($request->products as $item) {
            if (!isset($item['product_id']) || !isset($item['quantity'])) continue;

            $product = Product::find($item['product_id']);
            if (!$product) continue;

            $price = $product->price;
            $quantity = $item['quantity'];
            $total_price = $price * $quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'total_price' => $total_price,
            ]);

            $total += $total_price;
        }

        $order->update([
            'total_amount' => $total,
            'status' => $request->status ?? 'pending'
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng!');
    }

    // Xóa
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        OrderItem::where('order_id', $order->id)->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng!');
    }
}
