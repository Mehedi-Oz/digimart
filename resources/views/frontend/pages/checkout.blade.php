@extends('frontend.layouts.master')

@section('title')
    {{ __('Checkout') }}
@endsection

@section('content')
    <!-- ======================== Breadcrumb Two Section Start ===================== -->
    <section class="breadcrumb border-bottom p-0 d-block section-bg position-relative z-index-1"
        style="background: url({{ asset('assets/frontend/images/thumbs/breadcrumb_bg.jpg') }});">
        <div class="breadcrumb-two">
            <img src="assets/images/gradients/breadcrumb-gradient-bg.png" alt="" class="bg--gradient">
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
                                    <span class="breadcrumb-list__text">{{ __('Checkout') }}</span>
                                </li>
                            </ul>

                            <h3 class="breadcrumb-two-content__title mb-0 text-capitalize">{{ __('Checkout') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================== Breadcrumb Two Section End ===================== -->

    <!-- ======================= Cart Payment Section Start ========================= -->
    <section class="payment_page  padding-y-120 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="payment_area">
                        <div class="row">
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_1.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_2.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_3.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_4.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_5.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_6.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_7.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_8.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_1.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_2.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_3.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="#" class="payment_mathod" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <img src="assets/images/thumbs/payment_4.png" alt="payment" class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="total_payment_price">
                        <h4>Total Cart <span>{{ getCartCount() }}</span></h4>
                        <ul>
                            <li>Total :<span>${{ getCartTotal() }}</span></li>
                        </ul>
                        <a href="#" class="btn btn-main btn-lg">now payment</a>
                    </div>
                </div>
            </div>

            <div class="payment_modal">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In sint laboriosam doloribus
                                soluta
                                labore veniam enim deleniti necessitatibus modi. Velit odit sed assumenda eligendi
                                laboriosam.</p>

                            <ul class="modal_iteam">
                                <li>One popular belief, Lorem Ipsum is not simply random.</li>
                                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                <li>To popular belief, Lorem Ipsum is not simply random.</li>
                            </ul>

                            <form class="modal_form">
                                <div class="single_form">
                                    <label>Enter Something</label>
                                    <input type="text" placeholder="Enter Something">
                                </div>
                                <div class="single_form">
                                    <label>Enter Something</label>
                                    <textarea rows="4" placeholder="Enter Something"></textarea>
                                </div>
                                <div class="single_form">
                                    <label>select Something</label>
                                    <div class="select-has-icon">
                                        <select>
                                            <option value="">Select Something</option>
                                            <option value="">Something 1</option>
                                            <option value="">Something 2</option>
                                            <option value="">Something 3</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-main btn-lg modal_closs_btn"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-main btn-lg">submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Cart Payment Section End ========================= -->
@endsection
