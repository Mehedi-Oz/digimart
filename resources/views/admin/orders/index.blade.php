@extends('admin.layouts.master')

@section('title')
    {{ __('All Orders') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Orders') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Button Text') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Buyer</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th class="w-1">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>#{{ $order->code }}</td>
                                                <td class="">{{ $order->user->name }}</td>
                                                <td class="">{{ $order->transaction->paid_in_amount }} {{ $order->transaction->paid_in_currency_icon }}</a></td>
                                                <td>
                                                  <span class="badge bg-green text-green-fg">{{ $order->status }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" ><i class="ti ti-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-secondary text-center">{{ __('No orders found!') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
