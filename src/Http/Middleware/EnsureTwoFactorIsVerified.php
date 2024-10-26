<?php

namespace Antoinecorbin\Nova2fa\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactorIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !session()->get('2fa_passed') && !$request->routeIs(config('nova2fa.verification_route'))) {
            return redirect()->route(config('nova2fa.verification_route'));
        }

        return $next($request);
    }
}
