@extends('admin.payment-settings.master')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-4">{{ __('Stripe Settings') }}</h2>
            <form action="{{ route('admin.stripe-settings.update') }}" method="POST" class="x-form">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input-text name="stripe_publishable_key" :label="__('Publishable Key')" :value="config('settings.stripe_publishable_key')" />
                    </div>
                    <div class="col-md-6">
                        <x-admin.input-text name="stripe_secret_key" :label="__('Secret Key')" :value="config('settings.stripe_secret_key')" />
                    </div>
                    <div class="col-md-12">
                        <x-admin.input-select name="stripe_status" :label="__('Stripe Status')">
                            <option @selected(config('settings.stripe_status') == 'active') value="active">{{ __('Active') }}</option>
                            <option @selected(config('settings.stripe_status') == 'inactive') value="inactive">{{ __('Inactive') }}</option>
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
