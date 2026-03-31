<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;


class CategoryProductsController extends Controller
{
    public function index()
    {
        $productsCategories = CategoryProduct::paginate(20);
        
        return view('admin.productsCategories.index', compact('productsCategories'));
    }

    public function create()
    {
        // $productsCategories = CategoryProduct::where('parent_id', 0)->get();
        $productsCategories = null;
        return view('admin.productsCategories.edit', compact('productsCategories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'show' => 'nullable|boolean',
        ]);
       
        CategoryProduct::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'show' => $request->has('show'),
        ]);

        return redirect()->route('admin.productsCategories.index')->with('success', 'Thêm category thành công!');
    }

    public function edit($id)
    {
        $productsCategories = CategoryProduct::findOrFail($id);
        return view('admin.productsCategories.edit', compact('productsCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'show' => 'nullable|boolean',
        ]);

        $category = CategoryProduct::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id ?? 0,
            'show' => $request->has('show'),
        ]);

        return redirect()->route('admin.productsCategories.index')->with('success', 'Cập nhật category thành công!');
    }

    public function destroy($id)
    {
        $category = CategoryProduct::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.productsCategories.index')->with('success', 'Xóa category thành công!');
    }
}
