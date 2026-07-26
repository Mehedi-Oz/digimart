<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\KycVerificationStoreRequest;
use App\Models\KycSetting;
use App\Models\KycVerification;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class KycVerificationController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $kycSetting = KycSetting::first();
        return view('frontend.pages.kyc', compact('kycSetting'));
    }

    public function store(KycVerificationStoreRequest $request): RedirectResponse
    {
        $paths = [];
        foreach ($request->file('documents', []) as $file) {
            $paths[] = $this->uploadFile($file, 'frontend/kyc', 'local');
        }

        KycVerification::create([
            'user_id'         => Auth::id(),
            'document_type'   => $request->document_type,
            'document_number' => $request->document_number,
            'documents'       => json_encode($paths),
        ]);

        NotificationService::CREATED('KYC documents submitted successfully. Pending admin review.');
        return to_route('dashboard');
    }
}
