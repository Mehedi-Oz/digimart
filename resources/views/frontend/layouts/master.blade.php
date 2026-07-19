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
    <div class="preloader_area">
        <div class="preloader_img">
            <img src="{{ asset('assets/frontend/images/thumbs/preloader.gif') }}" alt="Preloader">
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
    @include('frontend.layouts.mobile-menu')
    <!-- ==================== Mobile Menu End Here ==================== -->

    <main class="change-gradient">

        <!-- ==================== Header Start Here ==================== -->
        @include('frontend.layouts.header')
        <!-- ==================== Header End Here ==================== -->

        <!-- ==================== Dynamic Content Start Here ==================== -->
        @yield('content')
        <!-- ==================== Dynamic Content End Here ==================== -->

        <!-- ==================== Footer Start Here ==================== -->
        @include('frontend.layouts.footer')
        <!-- ==================== Footer End Here ==================== -->

    </main>

    <!-- Js files -->
    @include('frontend.layouts.partials.scripts')

</body>

</html>
