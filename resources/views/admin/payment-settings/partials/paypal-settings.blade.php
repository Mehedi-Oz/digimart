@extends('admin.payment-settings.master')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-4">{{ __('Paypal Settings') }}</h2>
            <form action="{{ route('admin.paypal-settings.update') }}" method="POST" class="x-form">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <x-admin.input-select name="paypal_mode" :label="__('Paypal Mode')">
                            <option @selected(config('settings.paypal_mode') == 'sandbox') value="sandbox">{{ __('Sandbox') }}</option>
                            <option @selected(config('settings.paypal_mode') == 'live') value="live">{{ __('Live') }}</option>
                        </x-admin.input-select>
                    </div>
                    <div class="col-md-6">
                        <x-admin.input-text name="paypal_app_id" :label="__('App ID')" :value="config('settings.paypal_app_id')" />
                    </div>
                    <div class="col-md-6">
                        <x-admin.input-text name="paypal_client_id" :label="__('Client ID')" :value="config('settings.paypal_client_id')" />
                    </div>
                    <div class="col-md-12">
                        <x-admin.input-text name="paypal_secret_key" :label="__('Secret Key')" :value="config('settings.paypal_secret_key')" />
                    </div>
                    <div class="col-md-12">
                        <x-admin.input-select name="paypal_status" :label="__('Paypal Status')">
                            <option @selected(config('settings.paypal_status') == 'active') value="active">{{ __('Active') }}</option>
                            <option @selected(config('settings.paypal_status') == 'inactive') value="inactive">{{ __('Inactive') }}</option>
                        </x-admin.input-select>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <x-admin.submit-button :label="__('Save')" onclick="$('.x-form').submit();" />
            </div>
        </div>
    </div>
@endsection
