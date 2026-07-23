@extends('admin.layouts.master')

@section('title')
    {{ __('Update Role User') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Role User') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role-users.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <x-admin.input-text name="name" :label="__('Name')" :value="$admin->name" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text name="email" :label="__('Email')" :value="$admin->email" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text type="password" name="password" :label="__('Password')"
                                        placeholder="**********" />
                                </div>
                                <div class="col-md-6">
                                    <x-admin.input-text type="password" name="password_confirmation" :label="__('Confirm Password')"
                                        placeholder="**********" />
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-select name="role" :label="__('Role')">
                                        @foreach ($roles as $role)
                                            <option @selected($admin->hasRole($role->name)) value="{{ $role->name }}">
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </x-admin.input-select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Update Role User')" onclick="$('form').submit();" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
