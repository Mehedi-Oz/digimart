@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Create Withdraw Request') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Create Withdraw Request') }}</h5>
                <p>{{ __('Request a payout to your configured payment method.') }}</p>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('user.withdraws.index') }}">{{ __('Back to Withdraws') }}</a>
            </div>
        </div>
        <hr>
        <div class="row gy-4">
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget green">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-wallet"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->balance) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Current Balance') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget orange">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-clock"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->withdraws()->whereStatus('pending')->sum('amount')) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Pending Withdraw') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget blue">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-download"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->withdraws()->whereStatus('paid')->sum('amount')) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Total Withdraw') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-widget red">
                    <span class="dashboard-widget__icon">
                        <i class="ti ti-currency-dollar"></i>
                    </span>
                    <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                        <div>
                            <h4 class="dashboard-widget__number mb-1 mt-3">{{ currencyPosition(user()->authorSales()->sum('author_earning')) }}</h4>
                            <span class="dashboard-widget__text font-14">{{ __('Total Earnings') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if (!$withdrawInformation?->withdrawGateway)
            <div class="alert alert-warning">
                {{ __('Please set up your payout method before creating a withdraw request.') }}
                <a href="{{ route('profile.index') }}">{{ __('Go to Profile') }}</a>
            </div>
        @else
            @if ($pendingWithdraw)
                <div class="alert alert-info">
                    {{ __('You already have a pending withdraw request. You can create a new request once it is processed.') }}
                </div>
                <div>
                    <div class="">
                        <table class="table">
                            <tr>
                                <td>
                                    {{ __('Amount') }}:
                                </td>
                                <td class="text-start">
                                    {{ currencyPosition($pendingWithdraw->amount) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ __('Payment Method') }}:
                                </td>
                                <td class="text-start">
                                    {{ $pendingWithdraw->method }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ __('Account Info') }}:
                                </td>
                                <td class="text-start">
                                    {!! nl2br(e($pendingWithdraw->account)) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ __('Status') }}:
                                </td>
                                <td class="text-start">
                                    {{ ucfirst($pendingWithdraw->status) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ __('Date') }}:
                                </td>
                                <td class="text-start">
                                    {{ formatDate($pendingWithdraw->created_at) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            @else
            <div>
                <div class="">
                    <table class="table">
                        <tr>
                            <td>
                                {{ __('Payment Method') }}:
                            </td>
                            <td class="text-start">
                                {{ $withdrawInformation->withdrawGateway->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ __('Account Info') }}:
                            </td>
                            <td class="text-start">
                                {!! nl2br(e($withdrawInformation->information)) !!}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ __('Minimum Withdraw Amount') }}:
                            </td>
                            <td class="text-start">
                                {{ currencyPosition($withdrawInformation->withdrawGateway->minimum_amount) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ __('Maximum Withdraw Amount') }}:
                            </td>
                            <td class="text-start">
                                {{ currencyPosition($withdrawInformation->withdrawGateway->maximum_amount) }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <form action="{{ route('user.withdraws.store') }}" method="POST">
                @csrf
                <x-frontend.input-text type="number" name="amount" :label="__('Amount')" :value="old('amount')" :placeholder="__('Enter amount')"
                    :hint="__('Minimum: :min, Maximum: :max', [
                        'min' => currencyPosition($withdrawInformation->withdrawGateway->minimum_amount),
                        'max' => currencyPosition($withdrawInformation->withdrawGateway->maximum_amount),
                    ])" :required="true" />
                <button type="submit" class="btn btn-primary">{{ __('Submit Request') }}</button>
            </form>
            @endif
        @endif
    </div>
@endsection
