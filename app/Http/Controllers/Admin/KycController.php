<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class KycController extends Controller
{
    /**
     * List all KYC verification requests.
     */
    public function index(): View
    {
        $kycRequests = KycVerification::with('user')->paginate(25);
        return view('admin.kyc.index', compact('kycRequests'));
    }

    /**
     * Show a single KYC verification request.
     */
    public function show(KycVerification $kyc): View
    {
        return view('admin.kyc.show', compact('kyc'));
    }

    /**
     * Download a KYC document attachment.
     */
    public function downloadDocument(int $key_id, int $attachment_id)
    {
        $kyc = KycVerification::findOrFail($key_id);
        $attachmentPath = null;

        foreach (json_decode($kyc->documents) as $key => $value) {
            if ($key == $attachment_id) {
                $attachmentPath = $value;
                break;
            }
        }

        if (!$attachmentPath || !Storage::disk('local')->exists($attachmentPath)) {
            abort(404, 'File not found.');
        }

        return response()->file(Storage::disk('local')->path($attachmentPath));
    }


    /**
     * Update the status of a KYC verification request.
     */
    public function updateStatus(Request $request, KycVerification $kyc): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected']
        ]);
        $kyc->update(['status' => $request->status]);

        if ($kyc->status == 'approved') {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 1]);
        } else {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
        }


        NotificationService::UPDATED();
        return to_route('admin.kyc.index');
    }

    /**
     * Delete a KYC verification request.
     */
    public function destroy(string $id)
    {
        //
    }
}
