<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
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

    public function booking(Product $product)
    {
        $stores = Store::all();
        return view('booking', compact('product', 'stores'));
    }

    public function bookingSave(StoreBookingRequest $request, Product $product)
    {
        $bookingData = $request->only([
            'duration',
            'started_at',
            'store_id',
            'delivery_method',
            'address'
        ]);
        session($bookingData);
        return redirect()->route('checkout', $product->slug);
    }

    public function checkout(Product $product)
    {
        $dump = session('delivery_method');
        dd($dump);
    }
}
