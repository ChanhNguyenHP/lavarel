<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        // return response()->json(Product::all());
        return response()->json(
            Product::where('user_id', Auth::id())->get()
        );
    }

    public function detailProduct($id) {
        // $product = Product::find($id);
        $product = Product::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();
        if (!$product) return response()->json(['message'=>'Not found'],404);
        return response()->json($product);
    }

    public function saveProduct(Request $request, $id = null)
    {
        
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ];

        $request->validate($rules);


        if ($id) {
            // $product = Product::find($id);
            $product = Product::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$product) {
                return response()->json(['message' => 'Not found'], 404);
            }

            $product->update($request->only(['name','description','price']));
            return response()->json($product);
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        return response()->json($product, 201);
    }

    public function destroy($id) {
        // $product = Product::find($id);
        $product = Product::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();
        if (!$product) return response()->json(['message'=>'Not found'],404);

        $product->delete();
        return response()->json(['message'=>'Deleted']);
    }
}
