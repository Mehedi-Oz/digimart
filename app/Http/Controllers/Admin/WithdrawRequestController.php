<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\WithdrawMethod;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function index(): View
    {
        $withdrawRequests = Withdraw::with('author')
            ->orderByRaw("FIELD(status, 'pending', 'rejected', 'paid')")
            ->latest()
            ->paginate(25);

        return view('admin.withdraw-requests.index', compact('withdrawRequests'));
    }

    public function show(Withdraw $withdraw): View
    {
        $withdraw->load('author');

        $withdrawMethod = WithdrawMethod::where('name', $withdraw->method)->first();

        return view('admin.withdraw-requests.show', compact('withdraw', 'withdrawMethod'));
    }

    public function update(Request $request, Withdraw $withdraw): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,paid,rejected'],
        ]);

        if ($withdraw->status === 'paid') {
            NotificationService::ERROR(__('This withdraw request has already been paid and cannot be updated.'));

            return to_route('admin.withdraw.requests.index');
        }

        $amount = currencyPosition($withdraw->amount);

        if ($validated['status'] === 'paid') {
            $author = $withdraw->author;
            $author->balance = $author->balance - $withdraw->amount;
            $author->save();
            $withdraw->update(['status' => 'paid']);

            MailSenderService::sendMail(
                receiverName: $withdraw->author->name,
                receiverMail: $withdraw->author->email,
                mailSubject: __('Withdrawal Request Approved'),
                mailContent: __("Your withdrawal request for amount {$amount} has been approved")
            );
        } elseif ($validated['status'] === 'rejected') {
            $withdraw->update(['status' => 'rejected']);

            MailSenderService::sendMail(
                receiverName: $withdraw->author->name,
                receiverMail: $withdraw->author->email,
                mailSubject: __('Withdrawal Request Rejected'),
                mailContent: __("Your withdrawal request for amount {$amount} has been rejected please try again or contact support")
            );
        } else {
            $withdraw->update(['status' => 'pending']);
        }

        NotificationService::UPDATED();

        return to_route('admin.withdraw.requests.index');
    }
}
