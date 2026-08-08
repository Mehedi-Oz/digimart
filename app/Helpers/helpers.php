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

/* converting bytes */
if (! function_exists('formatSize')) {
    function formatSize($bytes, $decimalPlaces = 2)
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        $factor = min(
            floor(log($bytes, 1024)),
            count($sizes) - 1
        );

        return round($bytes / pow(1024, $factor), $decimalPlaces).' '.$sizes[$factor];
    }
}

/* get icons for items */
if (! function_exists('getIcon')) {
    function getIcon($mimeType): string
    {
        $fileIcon = 'bi-file-earmark';

        if (str_starts_with($mimeType, 'image/')) {
            $fileIcon = 'bi-file-earmark-image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            $fileIcon = 'bi-file-earmark-play';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            $fileIcon = 'bi-file-earmark-music';
        } elseif (str_ends_with($mimeType, 'pdf')) {
            $fileIcon = 'bi-file-earmark-pdf';
        } elseif (str_starts_with($mimeType, 'text/')) {
            $fileIcon = 'bi-file-earmark-text';
        } elseif (str_starts_with($mimeType, 'application/')) {
            $fileIcon = 'bi-file-earmark-zip';
        }

        return $fileIcon;
    }
}
