<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = CategoryProduct::where('show', 1)
        ->with('products') // cần relation
        ->get();
        return view('menu', compact('categories'));
    }
}
