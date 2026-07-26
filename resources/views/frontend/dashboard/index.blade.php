@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Dashboard') }}
@endsection

@section('content')
    @php $kycStatus = user()->kyc->first()?->status; @endphp
    @if (user()->kyc_status == 0 && $kycStatus == 'pending')
        <div class="alert alert-warning alert-dismissible d-flex align-items-center gap-2" role="alert">
            <i class="ti ti-alert-triangle fs-5"></i>
            <span>{{ __('Your KYC request is pending. You will get notified by the admin shortly.') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @elseif (user()->kyc_status == 0 && $kycStatus == 'rejected')
        <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2" role="alert">
            <i class="ti ti-circle-x fs-5"></i>
            <span>{{ __('Your KYC request has been rejected. Please resubmit your documents.') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @elseif (user()->kyc_status == 1 && $kycStatus == 'approved')
        <div class="alert alert-success alert-dismissible d-flex align-items-center gap-2" role="alert">
            <i class="ti ti-circle-check fs-5"></i>
            <span>{{ __('Your KYC has been verified successfully.') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <!-- welcome balance Content Start -->
    <div class="welcome-balance mt-2 mb-40 flx-between gap-2">
        <div class="welcome-balance__left">
            <h4 class="welcome-balance__title mb-0">{{ __('Welcome back!') }} {{ user()->name }}</h4>
        </div>
        <div class="welcome-balance__right flx-align gap-2">
            <span class="welcome-balance__text fw-500 text-heading">{{ __('Available Balance:') }}</span>
            <h4 class="welcome-balance__balance mb-0">{{ __("$580.00") }}</h4>
        </div>
    </div>
    <!-- welcome balance Content End -->

    <div class="dashboard-body__item-wrapper">

        <!-- dashboard body Item Start -->
        <div class="dashboard-body__item">
            <div class="row gy-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget green">
                        <span class="dashboard-widget__icon">
                            <i class="ti ti-list-details"></i>
                        </span>
                        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                            <div>
                                <h4 class="dashboard-widget__number mb-1 mt-3">{{ __('2M+') }}</h4>
                                <span class="dashboard-widget__text font-14">{{ __('Total Products') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget orange">
                        <span class="dashboard-widget__icon">
                            <i class="ti ti-currency-dollar"></i>
                        </span>
                        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                            <div>
                                <h4 class="dashboard-widget__number mb-1 mt-3">{{ __("$5289.00") }}</h4>
                                <span class="dashboard-widget__text font-14">{{ __('Total Earnings') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget blue">
                        <span class="dashboard-widget__icon">
                            <i class="ti ti-download"></i>
                        </span>
                        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                            <div>
                                <h4 class="dashboard-widget__number mb-1 mt-3">{{ __('5,2458') }}</h4>
                                <span class="dashboard-widget__text font-14">{{ __('Total Downloads') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="dashboard-widget red">
                        <span class="dashboard-widget__icon">
                            <i class="ti ti-basket-check"></i>
                        </span>
                        <div class="dashboard-widget__content flx-between gap-1 align-items-end">
                            <div>
                                <h4 class="dashboard-widget__number mb-1 mt-3">{{ __('2,589') }}</h4>
                                <span class="dashboard-widget__text font-14">{{ __('Total Sales') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- dashboard body Item End -->
    </div>
@endsection
