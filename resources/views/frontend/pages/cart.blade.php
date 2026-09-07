@extends('frontend.layouts.master')

@section('title')
    {{ __('Cart') }}
@endsection

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}" alt=""
                class="bg--gradient">
            <div class="container container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="breadcrumb-two-content text-center">

                            <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <a href="index.html"
                                        class="breadcrumb-list__link text-body hover-text-main">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__icon font-10"><i class="fas fa-chevron-right"></i></span>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__text">{{ __('Cart View') }}</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ __('Cart View') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->

    <!-- ======================= Cart Section Start ======================== -->
    <div class="cart padding-y-120">
        <div class="container">
            <div class="cart-content">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="details">Product Details</th>
                                <th class="price">Price</th>
                                <th class="delete_cart">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cartItems as $cartItem)
                                <tr>
                                    <td class="details">
                                        <div class="cart-item">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="cart-item__thumb">
                                                    @if ($cartItem->item->preview_type == 'image')
                                                        <a href="product-details.html" class="link">
                                                            <x-frontend.image-preview :src="$cartItem->item->preview_image" />
                                                        </a>
                                                    @elseif($cartItem->item->preview_type == 'video')
                                                        <a href="product-details.html" class="link">
                                                            <img src="{{ asset('defaults/video.webp') }}" />
                                                        </a>
                                                    @elseif($cartItem->item->preview_type == 'audio')
                                                        <a href="product-details.html" class="link">
                                                            <img src="{{ asset('defaults/audio.webp') }}" />
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="cart-item__content">
                                                    <h6
                                                        class="cart-item__title font-heading fw-700 text-capitalize font-18 mb-4">
                                                        <a href="product-details.html"
                                                            class="link">{{ $cartItem->item->name }}</a>
                                                    </h6>
                                                    <span class="cart-item__price font-18 text-heading fw-500">Category:
                                                        <span
                                                            class="text-body font-14">{{ $cartItem->item->category->name }}
                                                            / {{ $cartItem->item->subCategory->name }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">
                                        @if ($cartItem->item->discount_price > 0)
                                            <span
                                                class="cart-item__totalPrice text-body font-18 fw-400 mb-0">${{ $cartItem->item->discount_price }}</span>
                                            <span
                                                class="cart-item__totalPrice text-body font-18 fw-400 mb-0 text-decoration-line-through"
                                                style="color: red !important;">${{ $cartItem->item->price }}</span>
                                        @else
                                            <span
                                                class="cart-item__totalPrice text-body font-18 fw-400 mb-0">${{ $cartItem->item->price }}</span>
                                        @endif
                                    </td>
                                    <td class="delete_cart">
                                        <span class="cart-item-remove" data-id={{ $cartItem->id }}><i
                                                class="ti ti-x"></i></span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">{{ __('No items found!') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="cart-content__bottom flx-between gap-2">
                    <a href="{{ route('products') }}" class="btn btn-outline-light flx-align gap-2 btn-lg">
                        <span class="icon line-height-1 font-20"><i class="las la-arrow-left"></i></span>
                        {{ __('Continue Shopping') }}
                    </a>
                    @if (getCartCount() > 0)
                        <a href="{{ route('checkout') }}" class="btn btn-main flx-align gap-2 btn-lg">
                            {{ __('Next') }}
                            <span class="icon line-height-1 font-20"><i class="las la-arrow-right"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Cart Section End ======================== -->
@endsection
