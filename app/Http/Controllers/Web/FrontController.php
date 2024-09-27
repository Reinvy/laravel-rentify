<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        session()->put('product_id', $product->id);

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
        $duration = session('duration');

        $insurance = 900000;
        $ppn = 0.11;
        $price = $product->price;

        $subTotal =   $price * $duration;
        $totalPpn = $subTotal * $ppn;
        $grandTotal = $subTotal + $totalPpn + $insurance;

        return view('checkout', compact('product', 'subTotal', 'totalPpn', 'grandTotal', 'insurance'));
    }

    public function checkoutStore(StorePaymentRequest $request)
    {
        $bookingData = session()->only(['duration', 'started_at', 'store_id', 'delivery_method', 'address', 'product_id']);

        $duration = (int) $bookingData['duration'];
        $startedDate = Carbon::parse($bookingData['started_at']);

        $productDetail = Product::find($bookingData['product_id']);
        if (!$productDetail) {
            return redirect()->back()->withErrors(['product_id' => 'Product not found']);
        }

        $insurance = 900000;
        $ppn = 0.11;
        $price = $productDetail->price;

        $subTotal =   $price * $duration;
        $totalPpn = $subTotal * $ppn;
        $grandTotal = $subTotal + $totalPpn + $insurance;

        $bookingTransactionId = null;

        DB::transaction(function () use ($request, &$bookingTransactionId, $duration, $bookingData, $grandTotal, $productDetail, $startedDate) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $endedDate = $startedDate->copy()->addDays($duration);

            $validated['started_at'] = $startedDate;
            $validated['ended_at'] = $endedDate;
            $validated['duration'] = $duration;
            $validated['total_amount'] = $grandTotal;
            $validated['store_id'] = $bookingData['store_id'];
            $validated['product_id'] = $bookingData['product_id'];
            $validated['delivery_method'] = $bookingData['delivery_method'];
            $validated['address'] = $bookingData['address'];
            $validated['is_paid'] = false;
            $validated['trx_id'] = Transaction::generateUniqueTrxId();

            $newBooking = Transaction::create($validated);

            $bookingTransactionId = $newBooking->id;
        });

        return redirect()->route('success.booking', $bookingTransactionId);
    }
}
