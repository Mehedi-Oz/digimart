<div class="mobile-menu d-lg-none d-block">
    <button type="button" class="close-button"> <i class="las la-times"></i> </button>
    <div class="mobile-menu__inner">
        <a href="{{ route('home') }}" class="mobile-menu__logo">
            <img src="{{ asset('assets/frontend/images/logo/logo-two.png') }}" alt="Logo" class="white-version">
        </a>
        <div class="mobile-menu__menu">
            <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">

                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <a href="javascript:;" onclick="event.preventDefault();this.closest('form').submit();"
                                        class="dropdown-item">Logout</a>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>

            <ul class="nav-menu flx-align nav-menu--mobile">
                <li class="nav-menu__item has-submenu">
                    <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                    <ul class="nav-submenu">
                        <li class="nav-submenu__item">
                            <a href="{{ route('home') }}" class="nav-submenu__link"> Home One</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="index-two.html" class="nav-submenu__link"> Home Two</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="index-three.html" class="nav-submenu__link"> Home Three</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-menu__item has-submenu">
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
                            <a href="profile.html" class="nav-submenu__link"> Profile</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="cart.html" class="nav-submenu__link"> Shopping Cart</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="cart-personal.html" class="nav-submenu__link"> Mailing Address</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="cart-payment.html" class="nav-submenu__link"> Payment Method</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="cart-thank-you.html" class="nav-submenu__link"> Preview Order</a>
                        </li>
                        <li class="nav-submenu__item">
                            <a href="dashboard.html" class="nav-submenu__link"> Dashboard</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-menu__item has-submenu">
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
            </ul>
        </div>
    </div>
</div>
