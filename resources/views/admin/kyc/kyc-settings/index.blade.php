@extends('admin.layouts.master')

@section('title')
    {{ __('KYC Settings') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.kyc-settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="mb-2">
                                    <label for="" class="form-label">{{ __('Verification Types') }}</label>
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-toggle name="nid_verification" :label="__('NID Verification')" :checked="$kycSetting->nid_verification" />
                                    <x-admin.input-toggle name="passport_verification" :label="__('Passport Verification')"
                                        :checked="$kycSetting->passport_verification" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text-area name="instructions" :label="__('Instructions')" :value="$kycSetting->instructions" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-select name="auto_approve" :label="__('Auto Approve')">
                                        <option value="0" @selected($kycSetting->auto_approve == 0)>{{ __('Disable') }}</option>
                                        <option value="1" @selected($kycSetting->auto_approve == 1)>{{ __('Enable') }}</option>
                                    </x-admin.input-select>
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-select name="status" :label="__('KYC Status')">
                                        <option value="0" @selected($kycSetting->status == 0)>{{ __('Inactive') }}</option>
                                        <option value="1" @selected($kycSetting->status == 1)>{{ __('Active') }}</option>
                                    </x-admin.input-select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Save')" onclick="$('form').submit()" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
