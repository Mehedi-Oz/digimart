@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Order Details') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Order Details') }}</h5>
                <p>{{ __('Purchased Item Details') }}</p>
            </div>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    {{ __('Back to Purchases') }}
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th class="details w-25">
                            {{ __('Order ID') }}
                        </th>
                        <td>{{ $purchase->code }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Purchase Date') }}
                        </th>
                        <td>{{ formatDate($purchase->created_at) }}</td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Status') }}
                        </th>
                        <td>
                            @if ($purchase->status == 'completed')
                                <div class="badge bg-success">{{ __('Completed') }}</div>
                            @elseif($purchase->status == 'processing')
                                <div class="badge bg-primary">{{ __('Processing') }}</div>
                            @elseif($purchase->status == 'pending')
                                <div class="badge bg-warning">{{ __('Pending') }}</div>
                            @elseif($purchase->status == 'cancelled')
                                <div class="badge bg-danger">{{ __('Cancelled') }}</div>
                            @endif
                        </td>
                    </tr>
                    @if ($purchase->transaction)
                        <tr>
                            <th>
                                {{ __('Transaction ID') }}
                            </th>
                            <td>{{ $purchase->transaction->payment_id }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Payment Method') }}
                            </th>
                            <td>{{ $purchase->transaction->payment_gateway }}</td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('Paid Amount') }}
                            </th>
                            <td>{{ config('settings.currency_icon') }}{{ $purchase->transaction->paid_amount }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th class="details">
                            {{ __('Item') }}
                        </th>
                        <th>
                            {{ __('Author') }}
                        </th>
                        <th>
                            {{ __('Quantity') }}
                        </th>
                        <th>
                            {{ __('Price') }}
                        </th>
                        <th class="action">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchase->purchaseItems as $item)
                        <tr>
                            <td class="details">
                                <div class="d-flex align-items-center">
                                    <div class="ms-1">
                                        <h6 class="mb-0">{{ $item->item->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->item->author?->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ config('settings.currency_icon') }}{{ $item->price }}</td>
                            <td class="action text-center">
                                <a href="{{ route('orders.download', $item->id) }}"
                                    class="btn btn-sm btn-success">
                                    <i class="ti ti-download"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($purchase->transaction)
                        <tr>
                            <td colspan="3" class="text-end fw-bold">
                                {{ __('Total') }}
                            </td>
                            <td class="fw-bold">
                                {{ config('settings.currency_icon') }}{{ $purchase->transaction->paid_amount }}
                            </td>
                            <td></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
