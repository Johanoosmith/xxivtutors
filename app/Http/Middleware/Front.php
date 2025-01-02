<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class Front {
    public function handle($request, Closure $next) {

        if ( Auth::check() && Auth::user()->role_id == '10' ) {
            return redirect('/admin');
        }elseif ( Auth::check() && Auth::user()->role_id == '1' ) {
            return redirect('/customer');
        }

        return $next($request);
    }
}
