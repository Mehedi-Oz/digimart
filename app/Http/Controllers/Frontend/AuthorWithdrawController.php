<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorWithdrawController extends Controller
{
    public function index(): View
    {
        $withdraws = user()->withdraws()->latest()->paginate(25);

        return view('frontend.dashboard.withdraws.index', compact('withdraws'));
    }

    public function create(): View
    {
        $withdrawInformation = user()->withdrawInformation()->with('withdrawGateway')->first();
        $pendingWithdraw = user()->withdraws()->whereStatus('pending')->latest()->first();

        return view('frontend.dashboard.withdraws.create', compact('withdrawInformation', 'pendingWithdraw'));
    }

    public function store(Request $request): RedirectResponse
    {
        $withdrawInformation = user()->withdrawInformation()->with('withdrawGateway')->first();

        if (! $withdrawInformation?->withdrawGateway) {
            NotificationService::ERROR(__('Please set up your payout method first.'));

            return to_route('profile.index');
        }

        if (user()->withdraws()->whereStatus('pending')->exists()) {
            NotificationService::ERROR(__('You already have a pending withdraw request.'));

            return to_route('user.withdraws.index');
        }

        $gateway = $withdrawInformation->withdrawGateway;

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:'.$gateway->minimum_amount, 'max:'.min($gateway->maximum_amount, user()->balance)],
        ], [
            'amount.max' => __('Insufficient balance.'),
        ]);

        Withdraw::create([
            'author_id' => user()->id,
            'amount' => $validated['amount'],
            'method' => $gateway->name,
            'account' => $withdrawInformation->information,
            'status' => 'pending',
        ]);

        NotificationService::CREATED(__('Withdraw request submitted successfully.'));

        return to_route('user.withdraws.index');
    }
}
