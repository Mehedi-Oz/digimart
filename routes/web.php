<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\KycVerificationController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Profile Management Routes */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

    /* KYC Settings Management Routes */
    Route::get('/kyc', [KycVerificationController::class, 'index'])->name('kyc.index')->middleware('kyc');
    Route::post('/kyc', [KycVerificationController::class, 'store'])->name('kyc.store')->middleware('kyc');

    /* Cart Management Routes */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart/{id}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/add-to-cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    /* Checkout Management Routes */
    Route::get('/checkout', CheckoutController::class)->name('checkout');
});

/* Author Management Routes */
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::group(['middleware' => ['is_author']], function () {
        Route::get('/items', [ItemController::class, 'index'])->name('items.index');
        Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/items/uploads', [ItemController::class, 'itemUploads'])->name('items.uploads');
        Route::delete('/items/destroy/{id}', [ItemController::class, 'itemDestroy'])->name('items.destroy');
        Route::post('/items/store', [ItemController::class, 'itemStore'])->name('items.store');
        Route::get('/items/edit/{id}', [ItemController::class, 'itemEdit'])->name('items.edit');
        Route::PUT('/items/update/{id}', [ItemController::class, 'itemUpdate'])->name('items.update');
        Route::get('/items/download/{id}', [ItemController::class, 'itemDownload'])->name('items.download');
        Route::get('/items/changelog/{id}', [ItemController::class, 'itemChangelog'])->name('items.changelog');
        Route::post('/items/changelog/{id}', [ItemController::class, 'storeChangelog'])->name('items.changelog.store');
        Route::get('/items/history/{id}', [ItemController::class, 'itemHistory'])->name('items.history');
    });
});

require __DIR__.'/auth.php';
