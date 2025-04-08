<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class StudentRoleVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		
		$user = Auth::user();
		
		// If user is not authenticated, deny access
        if (!$user) {
			if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }else{
				return redirect()->back()->with('error','User authentication is required.');
			}
        }

        // Check if user has the required role
        if ($user->role_id != config('constants.ROLE.STUDENT')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }else{
				return redirect()->back()->with('error','Forbidden - You do not have the required role');
			}
        }
		
        return $next($request);
    }
}
