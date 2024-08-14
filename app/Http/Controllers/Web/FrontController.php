<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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

        // return view($category->name);
        return view('brands', compact('category'));
    }
}
