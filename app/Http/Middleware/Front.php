<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class Front {
    public function handle($request, Closure $next) {

        if ( Auth::check() && Auth::user()->role_id == config('constants.ROLE.ADMIN')) {
            return redirect('/admin');
        }elseif ( Auth::check() && Auth::user()->role_id == config('constants.ROLE.STUDENT')) {
            return redirect('/customer');
        }

        return $next($request);
    }
}
