<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * The callback that should be used to generate the authentication redirect path.
     *
     * @var callable|null
     */
    protected static $redirectToCallback;

    /**
     * Specify the guards for the middleware.
     *
     * @param  string  $guard
     * @param  string  $others
     * @return string
     */
    public static function using($guard, ...$others)
    {
        return static::class . ':' . implode(',', [$guard, ...$others]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($this->redirectTo($request, $guard));
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are authenticated.
     */
    protected function redirectTo(Request $request, ?string $guard = 'web'): ?string
    {
        if (static::$redirectToCallback) {
            $uri = call_user_func(static::$redirectToCallback, $request);
            // Ensure the result is a safe internal URI string
            return is_string($uri) ? $uri : $this->defaultRedirectUri($guard);
        }

        return $this->defaultRedirectUri($guard);
    }


    /**
     * Get the default URI the user should be redirected to when they are authenticated.
     */
    protected function defaultRedirectUri($guard): string
    {
        if ($guard === 'admin') {
            return Route::has('admin.dashboard') ? route('admin.dashboard') : '/admin/dashboard';
        }
        if ($guard === 'web') {
            return Route::has('dashboard') ? route('dashboard') : '/dashboard';
        }

        return '/';
    }   

    /**
     * Specify the callback that should be used to generate the redirect path.
     *
     * @param  callable  $redirectToCallback
     * @return void
     */
    public static function redirectUsing(callable $redirectToCallback)
    {
        static::$redirectToCallback = $redirectToCallback;
    }
}
