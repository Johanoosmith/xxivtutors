<?php

namespace App\Http\Middleware;


use Closure;
use Auth;

class Customer
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect(route('login'));
            }
        }

        return $next($request);
    }
}
