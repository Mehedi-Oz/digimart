<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/logo/favicon-two.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome-all.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min.css') }}">
    <!-- Tabler Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
        integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Option Searching -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/select2.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

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

    <!--==================== Sidebar Overlay End ====================-->
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

    <!-- Jquery js -->
    <script src="{{ asset('assets/frontend/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('assets/frontend/js/boostrap.bundle.min.js') }}"></script>
    <!-- CountDown -->
    <script src="{{ asset('assets/frontend/js/countdown.js') }}"></script>
    <!-- counter up -->
    <script src="{{ asset('assets/frontend/js/counterup.min.js') }}"></script>
    <!-- Slick js -->
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}"></script>
    <!-- apex chart -->
    <script src="{{ asset('assets/frontend/js/apexchart.js') }}"></script>
    <!-- marquee -->
    <script src="{{ asset('assets/frontend/js/marquee.min.js') }}"></script>
    <!-- infinite slide  -->
    <script src="{{ asset('assets/frontend/js/infiniteslidev2.js') }}"></script>
    <!-- Option Searching  -->
    <script src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>


</body>

</html>
