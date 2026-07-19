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
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" onclick="event.preventDefault(); const p = this.closest('.input-group').querySelector('input'); const show = p.type === 'password'; p.type = show ? 'text' : 'password'; this.querySelector('.icon-eye').classList.toggle('d-none', show); this.querySelector('.icon-eye-off').classList.toggle('d-none', !show);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-eye-off d-none" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 3l18 18" />
                                    <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                                    <path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c3.6 0 6.6 2 9 6c-.822 1.37 -1.716 2.513 -2.684 3.432" />
                                    <path d="M6.158 6.158c-1.346 1.071 -2.545 2.521 -3.158 3.842c2.4 4 5.4 6 9 6c1.06 0 2.071 -.195 3.02 -.55" />
                                </svg>
                            </a>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-flat">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="{{ __('Confirm password') }}" required autocomplete="new-password">
                        <span class="input-group-text">
                            <a href="#" class="link-secondary" title="Show password" onclick="event.preventDefault(); const p = this.closest('.input-group').querySelector('input'); const show = p.type === 'password'; p.type = show ? 'text' : 'password'; this.querySelector('.icon-eye').classList.toggle('d-none', show); this.querySelector('.icon-eye-off').classList.toggle('d-none', !show);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-eye-off d-none" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 3l18 18" />
                                    <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                                    <path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c3.6 0 6.6 2 9 6c-.822 1.37 -1.716 2.513 -2.684 3.432" />
                                    <path d="M6.158 6.158c-1.346 1.071 -2.545 2.521 -3.158 3.842c2.4 4 5.4 6 9 6c1.06 0 2.071 -.195 3.02 -.55" />
                                </svg>
                            </a>
                        </span>
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
