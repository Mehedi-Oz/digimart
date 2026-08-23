@extends('frontend.layouts.master')

@section('title')
    {{ __('All Products') }}
@endsection

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background-image: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="{{ asset('assets/frontend/images/gradients/breadcrumb-gradient-bg.png') }}" alt="" class="bg--gradient">
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
                                    <span class="breadcrumb-list__text">{{ __('Products') }}</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ __('All Products') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->

    <!-- ======================== All Product Section Start ====================== -->
    <section class="all-product padding-y-120">
        <div class="container container-two">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-tab gap-3 flx-between">
                        <button type="button"
                            class="filter-tab__button btn btn-outline-light pill d-flex align-items-center">
                            <span class="icon icon-left"><i class="ti ti-filter"></i></span>
                            <span class="font-18 fw-500">Filters</span>
                        </button>
                        <ul class="nav common-tab nav-pills mb-0 gap-lg-2 gap-1 ms-lg-auto" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-product-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-product" type="button" role="tab"
                                    aria-controls="pills-product" aria-selected="true">All Item</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestMatch-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-bestMatch" type="button" role="tab"
                                    aria-controls="pills-bestMatch" aria-selected="false">Best Match</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestRating-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-bestRating" type="button" role="tab"
                                    aria-controls="pills-bestRating" aria-selected="false">Best Rating</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-trending" type="button" role="tab"
                                    aria-controls="pills-trending" aria-selected="false">Site Template</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestOffers-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-bestOffers" type="button" role="tab"
                                    aria-controls="pills-bestOffers" aria-selected="false">Best Offers</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bestSelling-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-bestSelling" type="button" role="tab"
                                    aria-controls="pills-bestSelling" aria-selected="false">Best Selling</button>
                            </li>
                        </ul>
                    </div>
                    <form action="#" class="filter-form pb-4 ">
                        <div class="row gy-3">
                            <div class="col-sm-4 col-xs-6">
                                <div class="flx-between gap-1">
                                    <label for="tag" class="form-label font-16">Tag</label>
                                    <button type="reset" class="text-body font-14">Clear</button>
                                </div>
                                <div class="position-relative">
                                    <input type="text" class="common-input border-gray-five common-input--withLeftIcon"
                                        id="tag" placeholder="Search By Tag...">
                                    <span class="input-icon input-icon--left"><img
                                            src="{{ asset('assets/frontend/images/icons/search-two.svg') }}" alt=""></span>
                                </div>
                            </div>
                            <div class="col-sm-4 col-xs-6">
                                <div class="flx-between gap-1">
                                    <label for="Price" class="form-label font-16">Price</label>
                                    <button type="reset" class="text-body font-14">Clear</button>
                                </div>
                                <div class="position-relative">
                                    <input type="text" class="common-input border-gray-five" id="Price"
                                        placeholder="$7 - $29">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="flx-between gap-1">
                                    <label for="time" class="form-label font-16">Time Frame</label>
                                    <button type="reset" class="text-body font-14">Clear</button>
                                </div>
                                <div class="position-relative select-has-icon">
                                    <select id="time" class="common-input border-gray-five">
                                        <option value="1">Now</option>
                                        <option value="2">Yesterday</option>
                                        <option value="2">1 Month Ago</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <!-- ===================== Filter Sidebar Start ============================= -->
                    <div class="filter-sidebar">
                        <!-- <button type="button"
                                    class="filter-sidebar__close p-2 position-absolute end-0 top-0 z-index-1 text-body hover-text-main font-20 d-lg-none d-block"><i
                                        class="las la-times"></i></button> -->
                        <div class="filter-sidebar__item">
                            <button type="button"
                                class="filter-sidebar__button font-16 text-capitalize fw-500">Category</button>
                            <div class="filter-sidebar__content">
                                <ul class="filter-sidebar-list">
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            All Categories <span class="qty">25489</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Site Template <span class="qty">12,501</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            WordPress <span class="qty">1258</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            UI Template <span class="qty">1520</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Templates Kits <span class="qty">210</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            eCommerce <span class="qty">158</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Marketing <span class="qty">178</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            CMS Template <span class="qty">122</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Muse Themes <span class="qty">450</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Blogging <span class="qty">155</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Courses <span class="qty">125</span>
                                        </a>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <a href="" class="filter-sidebar-list__text">
                                            Forums <span class="qty">35</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-sidebar__item">
                            <button type="button"
                                class="filter-sidebar__button font-16 text-capitalize fw-500">Rating</button>
                            <div class="filter-sidebar__content">
                                <ul class="filter-sidebar-list">
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="oneStar">
                                                <label class="form-check-label" for="oneStar">
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">(785)</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="twoStar">
                                                <label class="form-check-label" for="twoStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">(1250)</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="threeStar">
                                                <label class="form-check-label" for="threeStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">(7580)</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="fourStar">
                                                <label class="form-check-label" for="fourStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">(1450)</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="fiveStar">
                                                <label class="form-check-label" for="fiveStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">(2530)</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-sidebar__item">
                            <button type="button" class="filter-sidebar__button font-16 text-capitalize fw-500">Date
                                Updated</button>
                            <div class="filter-sidebar__content">
                                <ul class="filter-sidebar-list">
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="anyDate">
                                                <label class="form-check-label" for="anyDate"> Any Date</label>
                                            </div>
                                            <span class="qty"> 5,203</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="lastYear">
                                                <label class="form-check-label" for="lastYear"> In the last year</label>
                                            </div>
                                            <span class="qty">1,258</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="lastMonth">
                                                <label class="form-check-label" for="lastMonth"> In the last
                                                    month</label>
                                            </div>
                                            <span class="qty">2450</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="LastWeek">
                                                <label class="form-check-label" for="LastWeek"> In the last week</label>
                                            </div>
                                            <span class="qty">325</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    id="lastDay">
                                                <label class="form-check-label" for="lastDay"> In the last day</label>
                                            </div>
                                            <span class="qty">745</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- ===================== Filter Sidebar End ============================= -->
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-product" role="tabpanel"
                            aria-labelledby="pills-product-tab" tabindex="0">
                            <div class="row gy-4">
                                @forelse($products as $product)
                                  <x-frontend.product-card :product="$product" />
                                @empty
                                    <p>No data Found!</p>
                                @endforelse
                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->
                        </div>
                        <div class="tab-pane fade" id="pills-bestMatch" role="tabpanel"
                            aria-labelledby="pills-bestMatch-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (16)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        1200</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$120</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (66)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        108</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$236</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (78)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        2415</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (89)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4257</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$59</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm ">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (77)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        758</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$99</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (2689)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4598</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$256</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img7.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (510)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        578</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img8.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->

                        </div>
                        <div class="tab-pane fade" id="pills-bestRating" role="tabpanel"
                            aria-labelledby="pills-bestRating-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (16)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        1200</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$120</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (66)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        108</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$236</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (78)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        2415</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (89)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4257</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$59</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html"
                                                    class="btn btn-outline-light btn-sm ">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (77)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        758</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$99</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (2689)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4598</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$256</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img7.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (510)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        578</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img8.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->

                        </div>
                        <div class="tab-pane fade" id="pills-trending" role="tabpanel"
                            aria-labelledby="pills-trending-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (16)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        1200</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$120</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (66)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        108</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$236</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (78)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        2415</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (89)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4257</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$59</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html"
                                                    class="btn btn-outline-light btn-sm ">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (77)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        758</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$99</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (2689)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4598</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$256</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img7.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (510)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        578</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img8.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->

                        </div>
                        <div class="tab-pane fade" id="pills-bestOffers" role="tabpanel"
                            aria-labelledby="pills-bestOffers-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (16)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        1200</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$120</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (66)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        108</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$236</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (78)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        2415</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (89)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4257</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$59</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html"
                                                    class="btn btn-outline-light btn-sm ">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (77)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        758</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$99</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (2689)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4598</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$256</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img7.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (510)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        578</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img8.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->

                        </div>
                        <div class="tab-pane fade" id="pills-bestSelling" role="tabpanel"
                            aria-labelledby="pills-bestSelling-tab" tabindex="0">
                            <div class="row gy-4">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (16)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        1200</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$120</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (66)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        108</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$236</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (78)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        2415</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (89)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4257</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$59</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html"
                                                    class="btn btn-outline-light btn-sm ">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (77)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        758</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$99</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$129</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (2689)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        4598</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$256</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img7.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (510)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        578</span>

                                                </div>
                                            </div>
                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$129</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$259</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img8.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item ">
                                        <div class="product-item__thumb d-flex">
                                            <a href="product-details.html" class="link w-100">
                                                <img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}" alt=""
                                                    class="cover-img">
                                            </a>
                                            <button type="button" class="product-item__wishlist"><i
                                                    class="fas fa-heart"></i></button>
                                        </div>
                                        <div class="product-item__content">
                                            <div class="product-item__bottom flx-between gap-2">
                                                <div
                                                    class="d-flex flex-wrap justify-content-between align-items-center w-100">

                                                    <div class="d-flex align-items-center gap-1">
                                                        <ul class="star-rating">
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                            <li class="star-rating__item font-11"><i
                                                                    class="fas fa-star"></i></li>
                                                        </ul>
                                                        <span class="star-rating__text text-heading fw-500 font-14">
                                                            (4502)</span>
                                                    </div>
                                                    <span class="product-item__sales font-14"><i
                                                            class="ti ti-download"></i>
                                                        9875</span>

                                                </div>
                                            </div>

                                            <h6 class="product-item__title">
                                                <a href="product-details.html" class="link">SaaS dashboard digital
                                                    products
                                                    Title here</a>
                                            </h6>
                                            <div class="product-item__info flx-between gap-2">
                                                <span class="product-item__author">
                                                    by
                                                    <a href="profile.html" class="link hover-text-decoration-underline">
                                                        themepix</a>
                                                </span>
                                                <div class="flx-align gap-2">
                                                    <h6 class="product-item__price mb-0">$79</h6>
                                                    <span
                                                        class="product-item__prevPrice text-decoration-line-through">$99</span>
                                                </div>
                                            </div>
                                            <div class="product_item_footer">
                                                <a class="product_cart" href="#">
                                                    <i class="ti ti-shopping-cart-plus"></i>
                                                </a>
                                                <a href="product-details.html" class="btn btn-outline-light btn-sm">Live
                                                    Demo</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Pagination Start -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination common-pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link flx-align gap-2 flex-nowrap" href="#">Next
                                            <span class="icon line-height-1 font-20"><i
                                                    class="las la-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            <!-- Pagination End -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== All Product Section End ====================== -->
@endsection
