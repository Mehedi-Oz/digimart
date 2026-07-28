@extends('admin.setting.master')

@section('setting_content')
    <div class="col-12 col-md-9 d-flex flex-column">
        <div class="card-body">
            <h2 class="mb-4">{{ __('General Settings') }}</h2>
            <form action="{{ route('admin.setting.general-setting.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <x-admin.input-text name="site_name" :label="__('Site Name')" :value="config('settings.site_name')"/>
                    </div>
                    <div class="col-md-6">
                        <x-admin.input-text name="site_email" :label="__('Site Email')" :value="config('settings.site_email')"/>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-end">
                <x-admin.submit-button :label="__('Save')" onclick="$('form').submit();" />
            </div>
        </div>
    </div>
@endsection
