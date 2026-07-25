@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Profile') }}
@endsection

{{-- Persist active tab on password validation failure --}}
@php $showPasswordTab = $errors->hasAny(['current_password', 'password']); @endphp

@section('content')
    <div class="dashboard-body__content">
        <!-- Profile Content Start -->
        <div class="profile">
            <div class="row gy-4">
                <div class="col-xxl-3 col-xl-4">
                    <div class="profile-info">
                        <div class="profile-info__inner mb-40 text-center">

                            <x-frontend.image-preview :src="$user->avatar" style="height:128px; width:128px;" />
                            <br>
                            <h5 class="profile-info__name mb-1">{{ $user->name }}</h5>
                            <span class="profile-info__designation font-14">{{ $user->user_type }}</span>
                        </div>

                        <ul class="profile-info-list">
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-user"></i>
                                    <span class="text text-heading fw-500">{{ __('Name') }}</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->name }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-mail-forward"></i>
                                    <span class="text text-heading fw-500">{{ __('Email') }}</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->email }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-phone-plus"></i>
                                    <span class="text text-heading fw-500">{{ __('Phone') }}</span>
                                </span>
                                <span class="profile-info-list__info">+880 15589 236 45</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-map-pin"></i>
                                    <span class="text text-heading fw-500">{{ __('Country') }}</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->country ?? 'Not set' }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-currency-dollar"></i>
                                    <span class="text text-heading fw-500">{{ __('Balance') }}</span>
                                </span>
                                <span class="profile-info-list__info">${{ number_format($user->balance, 2) }}
                                    {{ __('BDT') }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-calendar-month"></i>
                                    <span class="text text-heading fw-500">{{ __('Member Since') }}</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->created_at?->format('M d, Y') }}</span>
                            </li>
                            <li class="profile-info-list__item">
                                <span class="profile-info-list__content flx-align flex-nowrap gap-2">
                                    <i class="ti ti-basket-check"></i>
                                    <span class="text text-heading fw-500">{{ __('Purchased') }}</span>
                                </span>
                                <span class="profile-info-list__info">{{ $user->total_sales }} {{ __('items') }}</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-xxl-9 col-xl-8">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header pb-0">
                            <ul class="nav tab-bordered nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading {{ $showPasswordTab ? '' : 'active' }}"
                                        id="pills-personalInfo-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-personalInfo" type="button" role="tab"
                                        aria-controls="pills-personalInfo"
                                        aria-selected="true">{{ __('Personal Info') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading" id="pills-payouts-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-payouts" type="button" role="tab"
                                        aria-controls="pills-payouts" aria-selected="false"
                                        tabindex="-1">{{ __('Payouts') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link font-18 font-heading {{ $showPasswordTab ? 'active' : '' }}"
                                        id="pills-changePassword-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-changePassword" type="button" role="tab"
                                        aria-controls="pills-changePassword" aria-selected="false"
                                        tabindex="-1">{{ __('Change Password') }}</button>
                                </li>
                            </ul>
                        </div>

                        <div class="profile-info-content">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade {{ $showPasswordTab ? '' : 'show active' }}"
                                    id="pills-personalInfo" role="tabpanel" aria-labelledby="pills-personalInfo-tab"
                                    tabindex="0">
                                    <form id="profile-form" action="{{ route('profile.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text id="update_avatar" type="file" name="avatar"
                                                    :label="__('Update Avatar')" />
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text name="name" :placeholder="__('enter full name')" :value="$user->name"
                                                    :label="__('Full Name')" />
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text type="email" name="email" :placeholder="__('enter your email')"
                                                    :value="$user->email" :label="__('Email')" />
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-select name="country" :label="__('Country')"
                                                    class="select_2">
                                                    @foreach (config('countries.countries') as $key => $value)
                                                        <option @selected($user->country == $value) value="{{ $value }}">
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </x-frontend.input-select>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text type="text" name="city" :placeholder="__('enter full city')"
                                                    :value="$user->city" :label="__('City')" />
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text type="text" name="address" :placeholder="__('enter full address')"
                                                    :value="$user->address" :label="__('Address')" />
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-main btn-lg">{{ __('Update Profile') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-payouts" role="tabpanel"
                                    aria-labelledby="pills-payouts-tab" tabindex="0">
                                    <form action="#" autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form_box">
                                                    <label for="name"
                                                        class="form-label mb-2 font-18 font-heading fw-600">{{ __('Full Name') }}</label>
                                                    <input type="text" class="common-input border" id="name"
                                                        value="Michel" placeholder="{{ __('enter full name') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form_box">
                                                    <label for="phone"
                                                        class="form-label mb-2 font-18 font-heading fw-600">{{ __('Full Name') }}</label>
                                                    <input type="tel" class="common-input border" id="phone"
                                                        value="+880 15589 236 45"
                                                        placeholder="{{ __('enter phone number') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <div class="form_box">
                                                    <label for="emailAdd"
                                                        class="form-label mb-2 font-18 font-heading fw-600">{{ __('Email') }}</label>
                                                    <input type="email" class="common-input border" id="emailAdd"
                                                        value="michel15@gmail.com"
                                                        placeholder="{{ __('Enter your email') }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn btn-main btn-lg">{{ __('Pay Now') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade {{ $showPasswordTab ? 'show active' : '' }}"
                                    id="pills-changePassword" role="tabpanel" aria-labelledby="pills-changePassword-tab"
                                    tabindex="0">
                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">

                                            <div class="col-12">
                                                <x-frontend.input-text type="password" id="current-password"
                                                    name="current_password" :placeholder="__('************')" :label="__('Current Password')" />
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text type="password" name="password" :placeholder="__('************')"
                                                    :label="__('New Password')" />
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <x-frontend.input-text type="password" name="password_confirmation"
                                                    :placeholder="__('************')" :label="__('Confirm Password')" />
                                            </div>

                                            <div class="col-sm-12">
                                                <button class="btn btn-main btn-lg">{{ __('Update Password') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Content End -->
    </div>
@endsection
