<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\KYCSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
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
    });
