<!-- ============================ Sale Offer Start =========================== -->
<div class="sale-offer ">
    <div class="container container-full ">
        <div class="sale-offer__content flx-between position-relative">
            <div class="sale-offer__countdown">

                <div class="countdown" data-date="14-10-2026" data-time="12:00">
                    <div class="day"><span class="num"></span><span class="word"></span></div>
                    <div class="hour"><span class="num"></span><span class="word"></span></div>
                    <div class="min"><span class="num"></span><span class="word"></span></div>
                    <div class="sec"><span class="num"></span><span class="word"></span></div>
                </div>

            </div>
            <div class="sale-offer__discount flx-align gap-2">
                <span class="sale-offer__text text-heading text-capitalize">New Year Flash Sale Offer</span>
                <strong class="sale-offer__qty text-heading font-heading">45% OFF</strong>
                <a href="#" class="btn btn-sm btn-white fw-500">Shop Now</a>
            </div>
            <div class="sale-offer__button">
                <button type="submit" class="sale-offer__close text-heading"><i class="las la-times"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Sale Offer End =========================== -->

<!-- ==================== Header Start Here ==================== -->
<header class="header">
    <div class="container container-full">
        <nav class="header-inner flx-between">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ route('home') }}" class="link white-version">
                    <img src="{{ asset('assets/frontend/images/logo/logo-two.png') }}" alt="Logo">
                </a>
                <a href="{{ route('home') }}" class="link dark-version">
                    <img src="{{ asset('assets/frontend/images/logo/white-logo.png') }}" alt="Logo">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">
                <ul class="nav-menu flx-align ">
                    <li class="nav-menu__item">
                        <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                    </li>
                    <li class="nav-menu__item">
                        <a href="javascript:void(0)" class="nav-menu__link">Products</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="all-product.html" class="nav-submenu__link"> All Products</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="product-details.html" class="nav-submenu__link"> Product Details</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Pages</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="profile.html" class="nav-submenu__link">Test 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="profile.html" class="nav-submenu__link">Test 02</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item">
                        <a href="javascript:void(0)" class="nav-menu__link">Blog</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="blog.html" class="nav-submenu__link"> Blog</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="blog-details.html" class="nav-submenu__link"> Blog Details</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="blog-details-sidebar.html" class="nav-submenu__link"> Blog Details
                                    Sidebar</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-menu__item">
                        <a href="contact.html" class="nav-menu__link">Contact</a>
                    </li>
                    <li class="nav-menu__item">
                        <a href="#" class="nav-menu__link">Start Selling</a>
                    </li>
                </ul>
            </div>
            <!-- Menu End  -->

            <!-- Header Right start -->
            <div class="header-right flx-align">
                <a href="cart.html" class="header-right__button cart-btn position-relative">
                    <i class="ti ti-basket"></i>
                    <span class="qty-badge font-12">0</span>
                </a>

                <div class="header-right__inner gap-3 flx-align d-lg-flex d-none">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('assets/frontend/images/icons/user.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="javascript:;" onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item">Logout</a>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
                <button type="button" class="toggle-mobileMenu d-lg-none"> <i class="las la-bars"></i> </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>
<!-- ==================== Header End Here ==================== -->

<!-- ==================== Category Menu Start ==================== -->
<section class="category_menu_area d-none d-lg-block">
    <div class="container container-full">
        <ul class="category_menu">
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Web Themes & Templates</a>
                <ul class="nav-submenu">
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">WordPress</a>
                        <ul class="child_menu">
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 02</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 03</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Elementor</a>
                        <ul class="child_menu">
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 02</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 03</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Hosting</a>
                        <ul class="child_menu">
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 02</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 03</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">HTML</a>
                        <ul class="child_menu">
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 02</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 03</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Shopify</a>
                        <ul class="child_menu">
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 01</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 02</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="#" class="nav-submenu__link">Child Menu 03</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Jamstack</a>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Marketing</a>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">Jamstack</a>
                    </li>
                    <li class="nav-submenu__item">
                        <a href="#" class="nav-submenu__link">CMS</a>
                    </li>
                </ul>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Code</a>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Video</a>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Audio</a>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Graphics</a>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">Photos</a>
            </li>
            <li class="category_menu_list has-submenu">
                <a class="category_menu_link" href="#">3D Files</a>
            </li>
        </ul>
    </div>
</section>
<!-- ==================== Category Menu End ==================== -->
