<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view("admin.categories.index", compact("categories"));
    }

    public function store(Request $request)
    {
        $data = $request->validate(["name" => "required|string|max:100"]);
        $data["type"] = "news";
        Category::create($data);
        return back()->with("success", "Kategori berhasil ditambahkan.");
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with("success", "Kategori berhasil dihapus.");
    }
}
