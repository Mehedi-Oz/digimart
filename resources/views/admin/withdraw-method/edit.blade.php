@extends('admin.layouts.master')

@section('title')
    {{ __('Update Method') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Method') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdrawal-methods.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.withdrawal-methods.update', $withdrawal_method->id) }}" class="x-form" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :label="__('Name')" :value="$withdrawal_method->name" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="minimum_amount" :label="__('Minimum Amount')" :value="$withdrawal_method->minimum_amount" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="maximum_amount" :label="__('Maximum Amount')" :value="$withdrawal_method->maximum_amount" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text-area name="description" :label="__('Description')" :value="$withdrawal_method->description" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-select name="status" :label="__('status')">
                                        <option @selected($withdrawal_method->status == 1) value="1">{{ __('Active') }}</option>
                                        <option @selected($withdrawal_method->status == 0) value="0">{{ __('Inactive') }}</option>
                                    </x-admin.input-select>
                                </div>
                                <div class="co-md-12 text-end">
                                    <x-admin.submit-button :label="__('Update')" onclick="$('.x-form').submit();" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
