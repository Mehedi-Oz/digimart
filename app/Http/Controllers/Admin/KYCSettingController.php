<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KycSettingUpdateRequest;
use App\Models\KycSetting;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class KYCSettingController extends Controller
{
    public function index(): View
    {
        $kycSetting = KycSetting::first();
        return view('admin.kyc.kyc-settings.index', compact('kycSetting'));
    }

    public function update(KycSettingUpdateRequest $request): RedirectResponse
    {
        KycSetting::updateOrCreate(
            ['id' => 1],
            $request->validated()
        );

        NotificationService::UPDATED();
        return redirect()->back();
    }
}
