@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('My Reviews') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h5>{{ __('My Reviews') }}</h5>
                <p>{{ __('Reviews you have left on purchased items') }}</p>
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
                            {{ __('Item') }}
                        </th>
                        <th class="rating">
                            {{ __('Rating') }}
                        </th>
                        <th class="review">
                            {{ __('Review') }}
                        </th>
                        <th class="p_date">
                            {{ __('Date') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td>{{ $reviews->firstItem() + $loop->index }}</td>
                            <td class="details">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if ($review->item->preview_type == 'image')
                                            <a href="{{ route('products.show', $review->item->slug) }}" class="link">
                                                <x-frontend.image-preview :src="$review->item->preview_image" class="cover-image" />
                                            </a>
                                        @elseif ($review->item->preview_type == 'video')
                                            <a href="{{ route('products.show', $review->item->slug) }}" class="link">
                                                <img src="{{ asset('defaults/video.webp') }}" alt="{{ __('Video preview') }}" class="cover-image">
                                            </a>
                                        @elseif ($review->item->preview_type == 'audio')
                                            <a href="{{ route('products.show', $review->item->slug) }}" class="link">
                                                <img src="{{ asset('defaults/audio.webp') }}" alt="{{ __('Audio preview') }}" class="cover-image">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1">
                                            <a href="{{ route('products.show', $review->item->slug) }}" class="text-decoration-none text-body">
                                                {{ $review->item->name }}
                                            </a>
                                        </h6>
                                        <span class="d-block mb-1 text-secondary">
                                            {{ $review->item->category?->name }}
                                            @if ($review->item->category?->name && $review->item->subcategory?->name) / @endif
                                            {{ $review->item->subcategory?->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-warning">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <i class="fa{{ $star <= $review->stars ? 's' : 'r' }} fa-star"></i>
                                    @endfor
                                    {{ $review->stars }}/5
                                </div>
                            </td>
                            <td>{{ $review->body ? Str::limit($review->body, 100) : '—' }}</td>
                            <td>{{ formatDate($review->created_at) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="py-4">
                                    <h5>{{ __('No Reviews Found') }}</h5>
                                    <p class="text-secondary">{{ __('You have not reviewed any items yet.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($reviews->hasPages())
            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
@endsection
