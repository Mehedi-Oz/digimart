<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Models\User;
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
        $user = Auth::user();
        return view('frontend.dashboard.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $user->fill(
            $request->safe()->except('avatar')
        );

        if ($request->hasFile('avatar')) {
            if ($user->avatar !== User::DEFAULT_AVATAR) {
                $this->deleteFile($user->avatar);
            }
            $user->avatar = $this->uploadFile(
                $request->file('avatar'),
                'frontend/avatars'
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

    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse{
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        NotificationService::UPDATED();
        return redirect()->back();
    }
}
