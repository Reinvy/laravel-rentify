<?php

use App\Http\Controllers\Web\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('category');

Route::get('/brand/{brand:slug}/products', [FrontController::class, 'brand'])->name('brand');

Route::get('/details/{product:slug}', [FrontController::class, 'category'])->name('details');

Route::get('/booking/{product:slug}', [FrontController::class, 'category'])->name('booking');

Route::post('/booking/{product:slug/save}', [FrontController::class, 'category'])->name('booking.save');

Route::get('/success-booking/{transaction}', [FrontController::class, 'category'])->name('success.booking');

Route::post('/checkout/finish', [FrontController::class, 'category'])->name('checkout.store');

Route::get('/checkout/{product:slug}/payment', [FrontController::class, 'category'])->name('checkout');

Route::get('/transactions', [FrontController::class, 'category'])->name('transactions');

Route::post('/transactions/details', [FrontController::class, 'category'])->name('transactions.details');
