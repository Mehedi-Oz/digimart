<?php

use App\Models\KycVerification;
use Illuminate\Support\Facades\Auth;

/* Get logged in user */

if (! function_exists('user')) {
  function user()
  {
    return Auth::guard('web')->user();
  }
}


/* Get pending kyc count */

if (!function_exists('pendingKycCount')) {
  function pendingKycCount(): int
  {
    return KycVerification::whereStatus('pending')->count();
  }
}
