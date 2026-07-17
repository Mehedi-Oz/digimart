@extends('admin.layouts.guest')

@section('title')
    {{ __('Admin Login') }}
@endsection

@section('content')
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
            @if (session('status'))
                <div class="alert alert-success" id="status-alert">{{ session('status') }}</div>
                <script>setTimeout(() => document.getElementById('status-alert').remove(), 4000)</script>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">{{ __('Email address') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="form-control"
                        placeholder="your@email.com" autocomplete="off">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        {{ __('Password') }}
                        <span class="form-label-description">
                            <a href="{{ route('admin.password.request') }}">{{ __('forgot password?') }}</a>
                        </span>
                    </label>
                    <div class="input-group input-group-flat">
                        <input type="password" class="form-control" placeholder="Your password" name="password" required>
                        <span class="input-group-text">
                            @if (Route::has('admin.password.request'))
                                <a href="{{ route('admin.password.request') }}" class="link-secondary" title="Show password"
                                    data-bs-toggle="tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </a>
                            @endif
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" />
                        <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
