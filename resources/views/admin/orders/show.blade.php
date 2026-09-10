@extends('admin.layouts.master')

@section('title')
    {{ __('Order Details') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Order Details') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Back to Orders') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><b>{{ __('Order ID') }}</b></th>
                                            <td>{{ $order->code }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('User') }}</b></th>
                                            <td>{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Transaction ID') }}</b></th>
                                            <td>{{ $order->transaction->payment_id }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Payment Method') }}</b></th>
                                            <td>{{ $order->transaction->payment_gateway }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Total Amount') }}</b></th>
                                            <td>{{ config('settings.currency_icon') }}{{ $order->transaction->paid_amount }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Paid in Amount') }}</b></th>
                                            <td>
                                                {{ $order->transaction->paid_in_amount }}
                                                {{ $order->transaction->paid_in_currency_icon }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Exchange Rate') }}</b></th>
                                            <td>{{ $order->transaction->exchange_rate }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b>{{ __('Status') }}</b></th>
                                            <td>
                                                @php
                                                    $statusClasses = [
                                                        'completed' => 'bg-green text-green-fg',
                                                        'processing' => 'bg-azure text-azure-fg',
                                                        'pending' => 'bg-yellow text-yellow-fg',
                                                        'cancelled' => 'bg-red text-red-fg',
                                                    ];
                                                    $badgeClass =
                                                        $statusClasses[$order->status] ??
                                                        'bg-secondary text-secondary-fg';
                                                @endphp
                                                <span class="badge {{ $badgeClass }}">{{ $order->status }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-transparent table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%"></th>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 1%">Qnt</th>
                                    <th class="text-end" style="width: 1%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->purchaseItems as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="strong mb-1">{{ $item->item->name }}</p>
                                            <div class="text-secondary">Author: {{ $item->item->author->name }}</div>
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">
                                            {{ config('settings.currency_icon') }}{{ $item->price }}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="strong text-end">Total</td>
                                    <td class="text-end">
                                        {{ config('settings.currency_icon') }}{{ $order->transaction->paid_amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
