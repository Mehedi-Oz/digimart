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
        @if (! $withdrawInformation?->withdrawGateway)
            <div class="alert alert-warning">
                {{ __('Please set up your payout method before creating a withdraw request.') }}
                <a href="{{ route('profile.index') }}">{{ __('Go to Profile') }}</a>
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
    </div>
@endsection
