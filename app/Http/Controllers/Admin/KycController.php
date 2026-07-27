<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycVerification;
use App\Models\User;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class KycController extends Controller
{
    use FileUpload;
    /**
     * List all KYC verification requests.
     */
    public function index(): View
    {
        $kycRequests = KycVerification::with('user')->latest()->paginate(25);
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
    public function downloadDocument(int $key, int $attachment): BinaryFileResponse
    {
        $kyc = KycVerification::findOrFail($key);
        $attachmentPath = null;

        foreach (json_decode($kyc->documents) as $key => $value) {
            if ($key == $attachment) {
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
            'status' => ['required', 'in:pending,approved,rejected'],
            'reject_reason' => ['nullable', 'string', 'max:255']
        ]);
        $kyc->update(['status' => $request->status, 'reject_reason' => $request->status === 'rejected' ? $request->reject_reason : null]);

        if ($kyc->status == 'approved') {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 1, 'user_type' => 'author']);
            MailSenderService::sendMail(
                receiverName: $kyc->user->name,
                receiverMail: $kyc->user->email,
                mailSubject: __('Your KYC verification has been approved'),
                mailContent: __('You can now sell products in our platform. Happy Selling!')
            );
        } elseif ($kyc->status == 'rejected') {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
            MailSenderService::sendMail(
                receiverName: $kyc->user->name,
                receiverMail: $kyc->user->email,
                mailSubject: __('Your KYC verification has been rejected'),
                mailContent: __('We are sorry to inform you that your kyc has been rejected. Reason: ' . $request->reject_reason)
            );
        } else {
            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
        }

        NotificationService::UPDATED();
        return to_route('admin.kyc.index');
    }

    /** 
     * Delete a KYC verification request.
     */
    public function destroy(KycVerification $kyc): JsonResponse|RedirectResponse
    {
        try {
            foreach (json_decode($kyc->documents ?? '[]') as $path) {
                $this->deleteFile($path, 'local');
            }

            User::findOrFail($kyc->user_id)?->update(['kyc_status' => 0]);
            $kyc->delete();

            NotificationService::DELETED();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
