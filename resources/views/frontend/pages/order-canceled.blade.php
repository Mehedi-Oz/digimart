@extends('frontend.layouts.master')

@section('title')
    {{ __('Order Canceled') }}
@endsection

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient">
            <div class="container container-two">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="breadcrumb-two-content text-center">

                            <ul class="breadcrumb-list flx-align gap-2 mb-2 justify-content-center">
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <a href="{{ route('home') }}"
                                        class="breadcrumb-list__link text-body hover-text-main">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__icon font-10"><i
                                            class="fas fa-chevron-right"></i></span>
                                </li>
                                <li class="breadcrumb-list__item font-14 text-body">
                                    <span class="breadcrumb-list__text">{{ __('Order') }}</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ __('Order') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->
    <section class="payment_page padding-y-120 overflow-hidden">
        <div class="container text-center">
            <i class="fas fa-times-circle fa-7x text-danger"></i>
            <h1 class="mt-3">{{ __('Order Canceled') }}</h1>
            <p class="mt-3">{{ __('Your order has been canceled') }}.</p>
            <a href="{{ route('products') }}" class="btn btn-main btn-lg fw-300 mt-4">{{ __('Continue Shopping') }}</a>
        </div>
    </section>
@endsection
