@extends('admin.layouts.master')

@section('title')
    {{ __('Payment Settings') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">{{ __('Payment Settings') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-md-3 border-end">
                            <div class="card-body">
                                <h4 class="subheader">{{ __('Settings') }}</h4>
                                <div class="list-group list-group-transparent">
                                    <a href="{{ route('admin.payment-settings.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center">{{ __('Paypal Settings') }}</a>
                                    <a href="{{ route('admin.stripe-settings.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center">{{ __('Stripe Settings') }}</a>
                                </div>
                            </div>
                        </div>

                        <!-- Setting Contents Start Here -->
                        @yield('setting_content')
                        <!-- Setting Contents Ends Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BODY -->
    </div>
@endsection
