<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all();
        $products = Product::latest()->take(6)->get();
        $randomProducts = Product::inRandomOrder()->take(6)->get();
        return view('index', compact('categories', 'products', 'randomProducts'));
    }

    public function category(Category $category)
    {
        session()->put('category_id', $category->id);
        return view('brands', compact('category'));
    }

    public function brand(Brand $brand)
    {
        $category = Category::find(session()->get('category_id'));
        $products = Product::where('brand_id', $brand->id)
            ->where('category_id', $category->id)
            ->latest()
            ->get();
        return view('gadgets', compact('products', 'brand', 'category'));
    }

    public function details(Product $product)
    {
        return view('details', compact('product'));
    }
}
