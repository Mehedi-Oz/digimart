@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Author Sales') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('Author Sales') }}</h5>
                <p>{{ __('All Sales History') }}.</p>
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
                            {{ __('Details') }}
                        </th>
                        <th class="price">
                            {{ __('Earning') }}
                        </th>
                        <th class="price">
                            {{ __('Platform Charge') }}
                        </th>
                        <th class="price">
                            {{ __('Amount') }}
                        </th>
                        <th class="p_date">
                            {{ __('Date') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">
                                <div>
                                    <h6>
                                        <a href="{{ route('products.show', $sale->item->slug) }}" target="_blank"
                                            class="text-decoration-none text-body">
                                            {{ $sale->item->name }}
                                        </a>
                                    </h6>
                                </div>
                                <div>
                                    <span>{{ $sale->item->category->name }} /
                                        {{ $sale->item->subcategory->name }}</span>
                                </div>
                            </td>
                            <td><b class="text-success">+{{ config('settings.currency_icon') }}{{ $sale->author_earning }}</b>
                            </td>
                            <td><b class="text-danger">-{{ config('settings.currency_icon') }}{{ $sale->amount - $sale->author_earning }}</b>
                            </td>
                            <td><b>{{ config('settings.currency_icon') }}{{ $sale->amount }}</b></td>
                            <td class="text-start">{{ formatDate($sale->created_at) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="py-4">
                                    <h5>{{ __('No Sales Found') }}</h5>
                                    <p class="text-secondary">{{ __('You have not made any sales yet.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($sales->hasPages())
            <div class="mt-4">
                {{ $sales->links() }}
            </div>
        @endif
    </div>
@endsection