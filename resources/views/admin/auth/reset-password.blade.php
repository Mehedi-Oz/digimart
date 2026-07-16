@extends('admin.layouts.guest')

@section('title')
    {{ __('Reset Password') }}
@endsection

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Reset Password') }}</h2>
            <form method="POST" action="{{ route('admin.password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label class="form-label">{{ __('Email address') }}</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                        class="form-control" placeholder="your@email.com" autocomplete="username" autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('New Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('New password') }}"
                            required autocomplete="new-password">
                        <span class="input-group-text"></span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="{{ __('Confirm password') }}" required autocomplete="new-password">
                        <span class="input-group-text"></span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center text-secondary mt-3">
        {{ __('Remember your password?') }} <a href="{{ route('admin.login') }}">{{ __('Sign in') }}</a>
    </div>
@endsection
