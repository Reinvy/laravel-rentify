<?php

use App\Http\Controllers\Web\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('category');

Route::get('/brand/{brand:slug}/products', [FrontController::class, 'brand'])->name('brand');

Route::get('/details/{product:slug}', [FrontController::class, 'details'])->name('details');

Route::get('/booking/{product:slug}', [FrontController::class, 'booking'])->name('booking');

Route::post('/booking/{product:slug}/save', [FrontController::class, 'bookingSave'])->name('booking.save');

Route::get('/success-booking/{transaction}', [FrontController::class, 'successBooking'])->name('success.booking');

Route::post('/checkout/finish', [FrontController::class, 'checkoutStore'])->name('checkout.store');

Route::get('/checkout/{product:slug}/payment', [FrontController::class, 'checkout'])->name('checkout');

Route::get('/transactions', [FrontController::class, 'transactions'])->name('transactions');

Route::post('/transactions/details', [FrontController::class, 'transactionsDetails'])->name('transactions.details');
