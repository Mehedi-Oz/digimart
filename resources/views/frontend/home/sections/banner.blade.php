<section class="hero section-bg z-index-1">
    <img src="{{ asset('assets/frontend/images/gradients/banner-gradient.png') }}" alt=""
        class="bg--gradient white-version">

    <div class="container container-two">
        <div class="row gy-sm-5 gy-4">
            <div class="col-xl-6 col-lg-9 col-12">
                <div class="hero-inner position-relative">
                    <div>
                        <h1 class="hero-inner__title">{{ __("2 million+ well chosen digital") }}</h1>
                        <p class="hero-inner__desc font-18">{{ __("Explore the best premium themes and plugins
                            available for sale. Our unique collection is hand-curated by experts. Find and buy
                            the perfect premium theme today.") }}</p>

                        <div class="position-relative">
                            <div class="search-box">
                                <input type="text"
                                    class="common-input common-input--lg shadow-sm auto-suggestion-input"
                                    placeholder="Search theme, plugins & more...">
                                <button type="submit" class="btn btn-main btn-icon icon border-0"><img
                                        src="{{ asset('assets/frontend/images/icons/search.svg') }}"
                                        alt=""></button>
                            </div>

                            <ul class="auto-suggestion-list">
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Business in
                                        HTML") }}</a>
                                </li>
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Business in
                                        WordPress") }}</a>
                                </li>
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Business in
                                        CMS") }}</a>
                                </li>
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Ecommerce
                                        in HTML") }}</a>
                                </li>
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Ecommerce
                                        in WordPress") }}</a>
                                </li>
                                <li>
                                    <a href="#" class="auto-suggestion-list__item w-100 text-body">{{ __("Ecommerce
                                        in CMS") }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Tech List Start -->
                        <div class="popular-search d-flex flex-wrap align-items-start gap-3">
                            <h6 class="popular-search__title font-18 fw-700 mb-0 mt-1 flex-shrink-0 flx-align gap-1">
                                <span class="d-md-flex d-none">{{ __("Popular") }}</span> {{ __("Search:") }}
                            </h6>
                            <ul class="search-list">
                                <li class="search-list__item">
                                    <a href="all-product.html" class="search-list__link font-14 text-heading">{{ __("theme") }}</a>
                                </li>
                                <li class="search-list__item">
                                    <a href="all-product.html"
                                        class="search-list__link font-14 text-heading">{{ __("plugins") }}</a>
                                </li>
                                <li class="search-list__item">
                                    <a href="all-product.html" class="search-list__link font-14 text-heading">{{ __("ui
                                        template") }}</a>
                                </li>
                                <li class="search-list__item">
                                    <a href="all-product.html" class="search-list__link font-14 text-heading">{{ __("mobile
                                        app") }}</a>
                                </li>
                                <li class="search-list__item">
                                    <a href="all-product.html" class="search-list__link font-14 text-heading">{{ __("html
                                        template") }}</a>
                                </li>
                                <li class="search-list__item">
                                    <a href="all-product.html"
                                        class="search-list__link font-14 text-heading">{{ __("dashboard") }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-12 col-md-6 col-lg-4">
                <div class="hero-thumb">
                    <ul class="direction_right">
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img1.png') }}"
                                    alt="" /></a></li>
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img2.png') }}"
                                    alt="" /></a></li>
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img3.png') }}"
                                    alt="" /></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-12 col-md-6 col-lg-4 pt-5 sm_margin">
                <div class="hero-thumb">
                    <ul class="direction_left">
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img4.png') }}"
                                    alt="" /></a></li>
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img5.png') }}"
                                    alt="" /></a></li>
                        <li><a href="#"><img src="{{ asset('assets/frontend/images/thumbs/product-img6.png') }}"
                                    alt="" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
