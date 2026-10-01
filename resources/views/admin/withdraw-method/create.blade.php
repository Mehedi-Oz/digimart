@extends('admin.layouts.master')

@section('title')
    {{ __('Add New Method') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add New Method') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdrawal-methods.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.withdrawal-methods.store') }}" class="x-form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :label="__('Minimum Amount')" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="minimum_amount" :label="__('Minimum Amount')" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="maximum_amount" :label="__('Maximum Amount')" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text-area name="description" :label="__('Description')" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-select name="status" :label="__('status')">
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="2">{{ __('Inactive') }}</option>
                                    </x-admin.input-select>
                                </div>
                                <div class="co-md-12 text-end">
                                    <x-admin.submit-button :label="__('Create')" onclick="$('.x-form').submit();" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
