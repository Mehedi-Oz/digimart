@extends('frontend.layouts.master')

@section('title')
    {{ __('All Products') }}
@endsection

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background-image: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
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
                                            src="{{ asset('assets/frontend/images/icons/search-two.svg') }}"
                                            alt=""></span>
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
                                        <a href="{{ route('products') }}" class="filter-sidebar-list__text">
                                            All Categories <span class="qty">{{ $productCount }}</span>
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li class="filter-sidebar-list__item">
                                            <a href="{{ route('products', ['category' => $category->slug]) }}"
                                                class="filter-sidebar-list__text">
                                                {{ $category->name }}
                                                <span class="qty">{{ $category->items_count }}</span>
                                            </a>
                                        </li>
                                    @endforeach
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
                                                <input class="form-check-input" type="radio" name="rating"
                                                    value="5" id="fiveStar">
                                                <label class="form-check-label" for="fiveStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">({{ number_format($productCountByRating[5] ?? 0) }})</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="rating"
                                                    value="4" id="fourStar">
                                                <label class="form-check-label" for="fourStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">({{ number_format($productCountByRating[4] ?? 0) }})</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="rating"
                                                    value="3" id="threeStar">
                                                <label class="form-check-label" for="threeStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">({{ number_format($productCountByRating[3] ?? 0) }})</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="rating"
                                                    value="2" id="twoStar">
                                                <label class="form-check-label" for="twoStar">
                                                    <i class="ti ti-star"></i>
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">({{ number_format($productCountByRating[2] ?? 0) }})</span>
                                        </div>
                                    </li>
                                    <li class="filter-sidebar-list__item">
                                        <div class="filter-sidebar-list__text">
                                            <div class="common-check common-radio">
                                                <input class="form-check-input" type="radio" name="rating"
                                                    value="1" id="oneStar">
                                                <label class="form-check-label" for="oneStar">
                                                    <i class="ti ti-star"></i>
                                                </label>
                                            </div>
                                            <span class="qty">({{ number_format($productCountByRating[1] ?? 0) }})</span>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== All Product Section End ====================== -->
@endsection
