<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KycMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (user()->kyc->first()?->status == 'pending' || user()->kyc->first()?->status == 'approved') {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
