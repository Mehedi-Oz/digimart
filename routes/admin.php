<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\KYCSettingController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // disabled admin registration
        // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
        // Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

Route::middleware('auth:admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /* Profile Management Routes */
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');

        /* Role Management Routes */
        Route::resource('roles', RoleController::class);

        /* Role User Management Routes */
        Route::resource('role-users', RoleUserController::class);

        /* KYC Settings Management Routes */
        Route::get('/kyc-settings', [KYCSettingController::class, 'index'])->name('kyc-settings.index');
        Route::put('/kyc-settings', [KYCSettingController::class, 'update'])->name('kyc-settings.update');

        /* KYC Requests Management Routes */
        Route::get('/kyc/download-document/{kyc}/{attachment}', [KycController::class, 'downloadDocument'])->name('kyc.download-document');
        Route::put('/kyc/kyc-status/{kyc}', [KycController::class, 'updateStatus'])->name('kyc.status');
        Route::resource('kyc', KycController::class);

        /* Category Management Routes */
        Route::resource('categories', CategoryController::class);

        /* SubCategory Management Routes */
        Route::resource('sub-categories', SubCategoryController::class);

        /* Item Review Routes */
        Route::get('item-reviews/pending', [ItemReviewController::class, 'pending'])->name('item-reviews.pending');
        Route::get('item-reviews/approved', [ItemReviewController::class, 'approved'])->name('item-reviews.approved');
        Route::get('item-reviews/soft-rejected', [ItemReviewController::class, 'softRejected'])->name('item-reviews.soft-rejected');
        Route::get('item-reviews/hard-rejected', [ItemReviewController::class, 'hardRejected'])->name('item-reviews.hard-rejected');
        Route::get('item-reviews/resubmitted', [ItemReviewController::class, 'resubmitted'])->name('item-reviews.resubmitted');
        Route::get('item/{id}/download', [ItemReviewController::class, 'downloadItem'])->name('item.download');
        Route::get('item-reviews/{id}/show', [ItemReviewController::class, 'show'])->name('item-reviews.show');
        Route::post('item-reviews/{id}/status', [ItemReviewController::class, 'updateStatus'])->name('item-reviews.status');
        Route::post('item/{id}/change-log', [ItemReviewController::class, 'changeLogStore'])->name('item.change-log.store');

        /* Payment Management Routes */
        Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
        Route::post('paypal-settings', [PaymentSettingController::class, 'updatePaypalSettings'])->name('paypal-settings.update');

        Route::get('stripe-settings', [PaymentSettingController::class, 'stripeSetting'])->name('stripe-settings.index');
        Route::post('stripe-settings', [PaymentSettingController::class, 'updateStripeSetting'])->name('stripe-settings.update');

        Route::get('razorpay-settings', [PaymentSettingController::class, 'razorpaySetting'])->name('razorpay-settings.index');
        Route::post('razorpay-settings', [PaymentSettingController::class, 'updateRazorpaySetting'])->name('razorpay-settings.update');

        /* Settings Management Routes */
        Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('general-setting', [SettingController::class, 'updateGeneralSetting'])->name('setting.general-setting.update');
        Route::get('commission-setting', [SettingController::class, 'commissionSetting'])->name('setting.commission-setting.index');
        Route::post('commission-setting', [SettingController::class, 'updateCommissionSetting'])->name('setting.commission-setting.update');
    });
