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

if (! function_exists('pendingKycCount')) {
    function pendingKycCount(): int
    {
        return KycVerification::whereStatus('pending')->count();
    }
}

/* Check if the user is a author or a user in frontend */

if (! function_exists('isAuthor')) {
    function isAuthor(): bool
    {
        return user()->user_type === 'author' && user()->kyc_status == 1 ? true : false;
    }
}

/* Get formatted date */

if (! function_exists('formatDate')) {
    function formatDate(string $date): string
    {
        return date('d M, Y', strtotime($date));
    }
}

/* Check Permissions */

if (! function_exists('canAccess')) {
    function canAccess(array $permissions): bool
    {
        $user = auth()->guard('admin')->user();

        if (! $user) {
            return false;
        }

        return $user->hasRole('super admin') || $user->hasAnyPermission($permissions);
    }
}
