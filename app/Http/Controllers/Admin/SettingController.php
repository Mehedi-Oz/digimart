<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettingUpdateRequest;
use App\Models\Setting;
use App\Services\NotificationService;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    public function index(): View
    {
        return view('admin.setting.partials.general-setting');
    }

    public function updateGeneralSetting(GeneralSettingUpdateRequest $request): RedirectResponse
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
