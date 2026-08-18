@extends('frontend.layouts.master')

@section('title')
    {{ __('Cart') }}
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
                                    <a href="index.html" class="breadcrumb-list__link text-body hover-text-main">{{ __('Home') }}</a>
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
                                <th class="qnty">Quantity</th>
                                <th class="price">Price</th>
                                <th class="total">Total</th>
                                <th class="delete_cart">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="details">
                                    <div class="cart-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cart-item__thumb">
                                                <a href="product-details.html" class="link">
                                                    <img src="assets/images/thumbs/product-img2.png" alt=""
                                                        class="cover-img">
                                                </a>
                                            </div>
                                            <div class="cart-item__content">
                                                <h6
                                                    class="cart-item__title font-heading fw-700 text-capitalize font-18 mb-4">
                                                    <a href="product-details.html" class="link">Digital product name
                                                        here</a>
                                                </h6>
                                                <span class="cart-item__price font-18 text-heading fw-500">Category:
                                                    <span class="text-body font-14">WordPress</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="qnty">
                                    <div class="cart-item__count">
                                        <button data-decrease="data-decrease"> <i class="fas fa-minus"></i></button>
                                        <input data-value="data-value" type="number" value="2">
                                        <button data-increase="data-increase"><i class="fas fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="price">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$28.00</span>
                                </td>
                                <td class="total">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$56.00</span>
                                </td>
                                <td class="delete_cart">
                                    <span><i class="ti ti-x"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="details">
                                    <div class="cart-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cart-item__thumb">
                                                <a href="product-details.html" class="link">
                                                    <img src="assets/images/thumbs/product-img3.png" alt=""
                                                        class="cover-img">
                                                </a>
                                            </div>
                                            <div class="cart-item__content">
                                                <h6
                                                    class="cart-item__title font-heading fw-700 text-capitalize font-18 mb-4">
                                                    <a href="product-details.html" class="link">Digital product name
                                                        here</a>
                                                </h6>
                                                <span class="cart-item__price font-18 text-heading fw-500">Category:
                                                    <span class="text-body font-14">WordPress</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="qnty">
                                    <div class="cart-item__count">
                                        <button data-decrease="data-decrease"> <i class="fas fa-minus"></i></button>
                                        <input data-value="data-value" type="number" value="2">
                                        <button data-increase="data-increase"><i class="fas fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="price">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$28.00</span>
                                </td>
                                <td class="total">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$56.00</span>
                                </td>
                                <td class="delete_cart">
                                    <span><i class="ti ti-x"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="details">
                                    <div class="cart-item">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cart-item__thumb">
                                                <a href="product-details.html" class="link">
                                                    <img src="assets/images/thumbs/product-img4.png" alt=""
                                                        class="cover-img">
                                                </a>
                                            </div>
                                            <div class="cart-item__content">
                                                <h6
                                                    class="cart-item__title font-heading fw-700 text-capitalize font-18 mb-4">
                                                    <a href="product-details.html" class="link">Digital product name
                                                        here</a>
                                                </h6>
                                                <span class="cart-item__price font-18 text-heading fw-500">Category:
                                                    <span class="text-body font-14">WordPress</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="qnty">
                                    <div class="cart-item__count">
                                        <button data-decrease="data-decrease"> <i class="fas fa-minus"></i></button>
                                        <input data-value="data-value" type="number" value="3">
                                        <button data-increase="data-increase"><i class="fas fa-plus"></i></button>
                                    </div>
                                </td>
                                <td class="price">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$28.00</span>
                                </td>
                                <td class="total">
                                    <span class="cart-item__totalPrice text-body font-18 fw-400 mb-0">$96.00</span>
                                </td>
                                <td class="delete_cart">
                                    <span><i class="ti ti-x"></i></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="cart-content__bottom flx-between gap-2">
                    <a href="all-product.html" class="btn btn-outline-light flx-align gap-2 btn-lg">
                        <span class="icon line-height-1 font-20"><i class="las la-arrow-left"></i></span>
                        Continue Shopping
                    </a>
                    <a href="cart-personal.html" class="btn btn-main flx-align gap-2 btn-lg">
                        Next
                        <span class="icon line-height-1 font-20"><i class="las la-arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Cart Section End ======================== -->
@endsection
