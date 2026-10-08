@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('My Withdraws') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('My Withdraws') }}</h5>
                <p>{{ __('All Withdraw Requests') }}.</p>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ route('user.withdraws.create') }}">{{ __('New Withdraw Request') }}</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            {{ __('No') }}
                        </th>
                        <th class="amount">
                            {{ __('Amount') }}
                        </th>
                        <th class="status">
                            {{ __('Status') }}
                        </th>
                        <th class="p_date">
                            {{ __('Date') }}
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        {{-- @if ($withdraws->hasPages())
            <div class="mt-4">
                {{ $withdraws->links() }}
            </div>
        @endif --}}
    </div>
@endsection
