@extends('admin.layouts.guest')

@section('title')
    {{ __('Forget Password') }}
@endsection

@section('content')
    <form class="card card-md" action="{{ route('admin.password.email') }}" method="POST" autocomplete="off">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Forgot Password') }}</h2>
            <p class="text-secondary mb-4">{{ __('Enter your email address and we will send you a password reset link.') }}
            </p>
            @if (session('status'))
                <div class="alert alert-success mb-4" id="status-alert">{{ session('status') }}</div>
                <script>setTimeout(() => document.getElementById('status-alert').remove(), 4000)</script>
            @endif
            <div class="mb-3">
                <label class="form-label">{{ __('Email address') }}</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                    placeholder="{{ __('Enter email') }}" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                        <path d="M3 7l9 6l9 -6" />
                    </svg>
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
    <div class="text-center text-secondary mt-3">
        {{ __('Forget it,') }} <a href="{{ route('admin.login') }}">{{ __('send me back') }}</a>
        {{ __('to the sign in screen.') }}
    </div>
@endsection
