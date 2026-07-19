<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- CSS files -->
    @include('frontend.layouts.partials.styles')
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Overlay Start ====================-->
    <div class="overlay"></div>
    <!--==================== Overlay End ====================-->

    <!--==================== Sidebar Overlay Start ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ==================== Scroll to Top End Here ==================== -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- ==================== Scroll to Top End Here ==================== -->

    <!-- ==================== Mobile Menu Start Here ==================== -->
    @include('frontend.dashboard.layouts.mobile-menu')
    <!-- ==================== Mobile Menu End Here ==================== -->

    <!-- ================================== Dashboard Start =========================== -->
    <section class="dashboard">
        <div class="dashboard__inner d-flex">

            <!-- ===================== Dashboard Sidebar Start ======================= -->
            @include('frontend.dashboard.layouts.sidebar')
            <!-- ===================== Dashboard Sidebar End ======================= -->

            <div class="dashboard-body">

                <!-- Dashboard Nav Start -->
                <div class="dashboard-nav bg-white flx-between gap-md-3 gap-2">
                    <div class="dashboard-nav__left flx-align gap-md-3 gap-2">
                        <button type="button" class="icon-btn bar-icon text-heading bg-gray-seven flx-center">
                            <i class="las la-bars"></i>
                        </button>
                        <button type="button" class="icon-btn arrow-icon text-heading bg-gray-seven flx-center">
                            <img src="{{ asset('assets/frontend/images') }}/icons/angle-right.svg" alt="">
                        </button>
                        <form action="#" class="search-input d-sm-block d-none">
                            <span class="icon">
                                <img src="{{ asset('assets/frontend/images') }}/icons/search-dark.svg" alt=""
                                    class="white-version">
                                <img src="{{ asset('assets/frontend/images') }}/icons/search-dark-white.svg"
                                    alt="" class="dark-version">
                            </span>
                            <input type="text" class="common-input common-input--md common-input--bg pill w-100"
                                placeholder="Search here...">
                        </form>
                    </div>
                    <div class="dashboard-nav__right">
                        <div class="header-right flx-align">
                            <div class="header-right__inner gap-sm-3 gap-2 flx-align d-flex">

                                <div class="user-profile">
                                    <button class="user-profile__button flex-align">
                                        <span class="user-profile__thumb">
                                            <img src="{{ asset('assets/frontend/images') }}/thumbs/user-profile.png"
                                                class="cover-img" alt="">
                                        </span>
                                    </button>
                                    <ul class="user-profile-dropdown">
                                        <li class="sidebar-list__item">
                                            <a href="{{ route('profile.index') }}" class="sidebar-list__link">
                                                <span class="sidebar-list__icon">
                                                    <img src="{{ asset('assets/frontend/images') }}/icons/sidebar-icon2.svg"
                                                        alt="" class="icon">
                                                    <img src="{{ asset('assets/frontend/images') }}/icons/sidebar-icon-active2.svg"
                                                        alt="" class="icon icon-active">
                                                </span>
                                                <span class="text">{{ __('Profile') }}</span>
                                            </a>
                                        </li>

                                        <li class="sidebar-list__item">
                                            <a href="setting.html" class="sidebar-list__link">
                                                <span class="sidebar-list__icon">
                                                    <img src="{{ asset('assets/frontend/images') }}/icons/sidebar-icon10.svg"
                                                        alt="" class="icon">
                                                    <img src="{{ asset('assets/frontend/images') }}/icons/sidebar-icon-active10.svg"
                                                        alt="" class="icon icon-active">
                                                </span>
                                                <span class="text">{{ __('Settings') }}</span>
                                            </a>
                                        </li>
                                        <li class="sidebar-list__item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="javascript:;" class="sidebar-list__link"
                                                    onclick="event.preventDefault();this.closest('form').submit();">
                                                    <span class="sidebar-list__icon">
                                                        <i class="ti ti-logout"></i>
                                                    </span>
                                                    <span class="text">{{ __('Logout') }}</span>
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                <div class="language-select flx-align select-has-icon">
                                    <img src="{{ asset('assets/frontend/images') }}/icons/globe.svg" alt=""
                                        class="globe-icon white-version">
                                    <img src="{{ asset('assets/frontend/images') }}/icons/globe-white.svg"
                                        alt="" class="globe-icon dark-version">
                                    <select class="select py-0 ps-2 border-0 fw-500">
                                        <option value="1">{{ __('Eng') }}</option>
                                        <option value="2">{{ __('Bn') }}</option>
                                        <option value="3">{{ __('Eur') }}</option>
                                        <option value="4">{{ __('Urd') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard Nav End -->

                <div class="dashboard-body__content">
                    @yield('content')
                </div>

                <!-- ====================== Dashboard Footer Start ======================== -->
                @include('frontend.dashboard.layouts.footer')
                <!-- ====================== Dashboard Footer End ======================== -->

            </div>
        </div>
    </section>
    <!-- ================================== Dashboard End =========================== -->

    <!-- Js files -->
    @include('frontend.layouts.partials.scripts')

</body>

</html>
