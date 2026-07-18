@extends('admin.layouts.master')

@section('title')
    {{ __('Profile') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <form class="card" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h3 class="card-title">{{ __('Edit Profile') }}</h3>
                        <div class="row row-cards">
                            <div class="col-md-12">
                                <x-admin.image-preview :src="$user->avatar" style="height:128px; width:128px;" />
                            </div>
                            <div class="col-md-12">
                                <x-admin.input-text id="update_avatar" type="file" name="avatar" :label="__('Update Avatar')" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text type="text" name="name" :label="__('Full Name')" :placeholder="__('enter full name')"
                                    :value="$user->name" />
                            </div>

                            <div class="col-md-6">
                                <x-admin.input-text type="email" name="email" :label="__('Email')" :placeholder="__('enter your name')"
                                    :value="$user->email" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                    </div>
                </form>

                <form class="card mt-4" action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h3 class="card-title">{{ __('Update Password') }}</h3>
                        <div class="row row-cards">

                            <div class="col-md-4">
                                <x-admin.input-text type="password" name="current_password" :label="__('Current Password')"
                                    :placeholder="__('************')" />
                            </div>

                            <div class="col-md-4">
                                <x-admin.input-text type="password" name="password" :label="__('New Password')" :placeholder="__('************')" />
                            </div>

                            <div class="col-md-4">
                                <x-admin.input-text type="password" name="password_confirmation" :label="__('Confirm Password')"
                                    :placeholder="__('************')" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
