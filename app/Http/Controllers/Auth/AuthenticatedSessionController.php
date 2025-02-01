<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller {
    
    /**
     * Display the login view.
     */
    public function create(): View {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {
      
        
        $request->authenticate();
        
        if (
            isset(Auth::user()->role_id)
            && (Auth::user()->role_id != 2 && Auth::user()->role_id != 1)
        )
        {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            throw ValidationException::withMessages([
                'email' => trans('Your account not a front-end user accoount.'),
            ]);
        }else{
            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
              
                return redirect()->route('customer.dashboard'); // Replace 'home' with the correct route name
               // return redirect()->route('newsfeed');
            }elseif (Auth::user()->role_id == 2) {
                return redirect()->route('tutor.dashboard');
            }
            else{
                  Auth::guard('web')->logout();
                    $request->session()->invalidate();
                      throw ValidationException::withMessages([
                        'email' => trans('Your account has not been activated from the admin side.'),
                    ]);
                }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
