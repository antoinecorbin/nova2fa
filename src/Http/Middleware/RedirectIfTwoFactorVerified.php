<?php

namespace Antoinecorbin\Nova2fa\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Nova\Nova;

class RedirectIfTwoFactorVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && session()->get('2fa_passed')) {
            return redirect(Nova::path());
        }

        return $next($request);
    }
}
