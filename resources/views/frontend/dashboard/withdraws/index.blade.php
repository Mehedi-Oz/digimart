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
                    @forelse ($withdraws as $withdraw)
                        <tr>
                            <td>{{ $withdraws->firstItem() + $loop->index }}</td>
                            <td>{{ currencyPosition($withdraw->amount) }}</td>
                            <td>
                                @if ($withdraw->status == 'paid')
                                    <div class="badge bg-success">{{ __('Paid') }}</div>
                                @elseif($withdraw->status == 'pending')
                                    <div class="badge bg-warning">{{ __('Pending') }}</div>
                                @elseif($withdraw->status == 'rejected')
                                    <div class="badge bg-danger">{{ __('Rejected') }}</div>
                                @endif
                            </td>
                            <td>{{ formatDate($withdraw->created_at) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="py-4">
                                    <h5>{{ __('No Withdraws Found') }}</h5>
                                    <p class="text-secondary">{{ __('You have not made any withdraw requests yet.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($withdraws->hasPages())
            <div class="mt-4">
                {{ $withdraws->links() }}
            </div>
        @endif
    </div>
@endsection
