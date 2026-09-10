@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Transactions') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Transactions') }}</h5>
                <p>{{ __('Your Transaction History') }}.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            {{ __('No') }}
                        </th>
                        <th class="details">
                            {{ __('Transaction Id') }}
                        </th>
                        <th class="p_date">
                            {{ __('Method') }}
                        </th>
                        <th class="price">
                            {{ __('Paid Amount') }}
                        </th>
                        <th class="status">
                            {{ __('Status') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->payment_id }}</td>
                            <td>{{ $transaction->payment_gateway }}</td>
                            <td>{{ $transaction->paid_in_amount }} {{ $transaction->paid_in_currency_icon }}</td>
                            <td>
                                @if ($transaction->status == 'completed')
                                    <span class="badge bg-success text-white">{{ __('Completed') }}</span>
                                @else
                                    <span class="badge bg-warning text-white">{{ ucfirst($transaction->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="py-4">
                                    <h5>{{ __('No Transactions Found') }}</h5>
                                    <p class="text-secondary">{{ __('You have not made any transactions yet.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($transactions->hasPages())
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
@endsection