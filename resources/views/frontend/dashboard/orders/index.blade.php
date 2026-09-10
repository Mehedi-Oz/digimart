@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('All Purchases') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('All Purchases') }}</h5>
                <p>{{ __('Manage Purchased Items') }}</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            {{ __('ID') }}
                        </th>
                        <th class="details">
                            {{ __('Details') }}
                        </th>
                        <th class="p_date">
                            {{ __('Purchase Date') }}
                        </th>
                        <th class="action">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchases as $purchase)
                        <tr>
                            <td>#{{ $purchase->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if ($purchase->item->preview_type == 'image')
                                            <a href="{{ route('products.show', $purchase->item->slug) }}" class="link">
                                                <x-frontend.image-preview :src="$purchase->item->preview_image" class="cover-image" />
                                            </a>
                                        @elseif($purchase->item->preview_type == 'video')
                                            <a href="{{ route('products.show', $purchase->item->slug) }}" class="link">
                                                <img src="{{ asset('defaults/video.webp') }}" alt="video preview">
                                            </a>
                                        @elseif($purchase->item->preview_type == 'audio')
                                            <a href="{{ route('products.show', $purchase->item->slug) }}" class="link">
                                                <img src="{{ asset('defaults/audio.webp') }}" alt="audio preview">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1">
                                            <a href="{{ route('products.show', $purchase->item->slug) }}"
                                                class="text-decoration-none text-body">
                                                {{ $purchase->item->name }}
                                            </a>
                                        </h6>
                                        <span class="d-block mb-1 text-secondary">
                                            {{ $purchase->item->category->name }} /
                                            {{ $purchase->item->subcategory->name }}
                                        </span>
                                        <div class="mb-1 text-warning">
                                            @for ($index = 0; $index < 5; $index++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-0">
                                            <a href="{{ route('products.show', $purchase->item->slug) }}#reviews">(
                                                {{ __('Write a review') }} )</a>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>{{ formatDate($purchase->created_at) }}</p>
                            </td>
                            <td class="action text-center">
                                <a href="{{ route('orders.show', $purchase->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="ti ti-eye"></i>
                                </a>
                                <a href="{{ route('orders.download', $purchase->id) }}"
                                    class="btn btn-sm btn-success">
                                    <i class="ti ti-download"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="py-4">
                                    <h5>{{ __('No Purchases Found') }}</h5>
                                    <p class="text-secondary">{{ __('You have not purchased any items yet.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($purchases->hasPages())
            <div class="mt-4">
                {{ $purchases->links() }}
            </div>
        @endif
    </div>
@endsection
