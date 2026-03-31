<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request, $user_id) {
        if (!User::where('id', $user_id)->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(
            Product::where('user_id', $user_id)->get()
        );
    }
}
