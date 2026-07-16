<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')
  ->prefix('admin')
  ->as('admin.')
  ->group(function () {

    //disabled admin registration
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
  });
