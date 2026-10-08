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
        return view('frontend.dashboard.withdraws.index');
    }

    public function create(): View
    {
        $withdrawInformation = user()->withdrawInformation()->with('withdrawGateway')->first();

        return view('frontend.dashboard.withdraws.create', compact('withdrawInformation'));
    }

    public function store(Request $request): RedirectResponse
    {
        $withdrawInformation = user()->withdrawInformation()->with('withdrawGateway')->first();

        if (! $withdrawInformation?->withdrawGateway) {
            NotificationService::ERROR(__('Please set up your payout method first.'));

            return to_route('profile.index');
        }

        $gateway = $withdrawInformation->withdrawGateway;

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:'.$gateway->minimum_amount, 'max:'.$gateway->maximum_amount],
        ]);

        Withdraw::create([
            'user_id' => user()->id,
            'amount' => $validated['amount'],
            'method' => $gateway->name,
            'account' => $withdrawInformation->information,
        ]);

        NotificationService::CREATED(__('Withdraw request submitted successfully.'));

        return to_route('user.withdraws.index');
    }
}
