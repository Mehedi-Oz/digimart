<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PasswordUpdateRequest;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\Admin;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::guard('admin')->user();

        $user->fill(
            $request->safe()->except('avatar')
        );

        if ($request->hasFile('avatar')) {
            if ($user->avatar !== Admin::DEFAULT_AVATAR) {
                $this->deleteFile($user->avatar);
            }
            $user->avatar = $this->uploadFile(
                $request->file('avatar'),
                'admin/avatars'
            );
        }

        // Skip save and notification if nothing has changed
        if (!$user->isDirty()) {
            return redirect()->back();
        }

        $user->save();
        NotificationService::UPDATED();

        return redirect()->back();
    }

    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::guard('admin')->user();
        $user->password = bcrypt($request->password);
        $user->save();

        NotificationService::UPDATED();
        return redirect()->back();
    }
}
