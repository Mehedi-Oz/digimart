<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Models\AuthorWithdrawInformation;
use App\Models\User;
use App\Models\WithdrawMethod;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $user = Auth::user();
        $withdrawMethods = WithdrawMethod::whereStatus(1)->get();

        return view('frontend.dashboard.profile.index', compact('user', 'withdrawMethods'));
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
        if (! $user->isDirty()) {
            return redirect()->back();
        }

        $user->save();
        NotificationService::UPDATED();

        return redirect()->back();
    }

    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        NotificationService::UPDATED();

        return redirect()->back();
    }

    public function withdrawInfo(Request $request): RedirectResponse
    {
        $request->validate([
            'payout_method' => ['required', 'exists:withdraw_methods,id'],
            'information' => ['required'],
        ]);

        AuthorWithdrawInformation::updateOrCreate(
            ['author_id' => user()->id],
            [
                'withdraw_method_id' => $request->payout_method,
                'information' => $request->information,
            ]
        );

        NotificationService::UPDATED();

        return redirect()->back();
    }
}
