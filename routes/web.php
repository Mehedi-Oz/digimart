<?php

use App\Http\Controllers\Frontend\AuthorWithdrawController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\KycVerificationController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
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

    /* Payment Management Routes */
    Route::get('payment/completed', [PaymentController::class, 'completed'])->name('payment.completed');
    Route::get('payment/canceled', [PaymentController::class, 'canceled'])->name('payment.canceled');

    /* Paypal Routes */
    Route::get('payment/paypal', [PaymentController::class, 'payWithPaypal'])->name('payment.paypal');
    Route::get('payment/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('payment.paypal.success');
    Route::get('payment/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('payment.paypal.cancel');

    /* Stripe Routes */
    Route::get('payment/stripe', [PaymentController::class, 'payWithStripe'])->name('payment.stripe');
    Route::get('payment/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('payment.stripe.success');
    Route::get('payment/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('payment.stripe.cancel');

    /* Razorpay Routes */
    Route::get('payment/razorpay', [PaymentController::class, 'payWithRazorpay'])->name('payment.razorpay');
    Route::get('payment/razorpay/success', [PaymentController::class, 'razorpaySuccess'])->name('payment.razorpay.success');
    Route::get('payment/razorpay/cancel', [PaymentController::class, 'razorpayCancel'])->name('payment.razorpay.cancel');
    Route::get('payment/razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('payment.razorpay.redirect');

    /* Order Management Routes */
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/download/{id}', [OrderController::class, 'download'])->name('orders.download');
    Route::get('/transactions', [OrderController::class, 'transactions'])->name('transactions.index');
    Route::get('/sales', [OrderController::class, 'sales'])->name('sales.index');
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

        /* withdraw Management Routes */
        Route::post('/withdraw-info', [ProfileController::class, 'withdrawInfo'])->name('withdraw.info');
        Route::get('/withdraws', [AuthorWithdrawController::class, 'index'])->name('withdraws.index');
        Route::get('/withdraws/create', [AuthorWithdrawController::class, 'create'])->name('withdraws.create');
        Route::post('/withdraws', [AuthorWithdrawController::class, 'store'])->name('withdraws.store');
    });
});

require __DIR__.'/auth.php';
