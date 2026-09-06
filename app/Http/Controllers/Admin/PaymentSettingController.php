<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaypalSettingUpdateRequest;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(): View
    {
        return view('admin.payment-settings.partials.paypal-settings');
    }

    public function updatePaypalSettings(PaypalSettingUpdateRequest $request): RedirectResponse
    {
        foreach ($request->validated() as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        //clears previously cached data an caches new data
        $setting = app()->make(SettingService::class);
        $setting->clearCachedSettings();

        NotificationService::UPDATED();
        return redirect()->back();
    }
}
