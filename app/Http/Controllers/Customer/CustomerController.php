<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User; // Assuming you have a Customer model


class CustomerController extends Controller
{
    public function index()
    {
       
         // Fetch all customers from the database
        // $customers = Customer::all(); 
            //die("12121");
         // Pass the customers data to the view
         return view('customer.dashboard');
    }


    public function create(Request $request, $step = 1)
    {
        // Retrieve data from the session (if any)
        $formData = $request->session()->get('registration_form', []);

        return view('auth.register-step-' . $step, compact('formData', 'step'));
    }

    public function store(Request $request, $step)
    {
        // Validation rules for each step
        $rules = [];
        switch ($step) {
            case 1:
                $rules = [
                    'username' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed',
                ];
                break;
            case 2:
                $rules = [
                    'fist_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                    'phone' => 'required|string|max:15',
                ];
                break;
            case 3:
                $rules = [
                    'language' => 'required|string|max:255',
                ];
                break;
        }

        // Validate the request
        $validatedData = $request->validate($rules);

        // Save data to session
        $request->session()->put('registration_form.' . $step, $validatedData);

        if ($step < 3) {
            // Redirect to the next step
            return redirect()->route('register.step', $step + 1);
        }

        // On the last step, save the user
        $formData = $request->session()->get('registration_form');
        $user = User::create([
            'name' => $formData[1]['name'],
            'email' => $formData[1]['email'],
            'password' => Hash::make($formData[2]['password']),
            'address' => $formData[3]['address'],
            'phone' => $formData[3]['phone'],
        ]);

        // Clear the session
        $request->session()->forget('registration_form');

        // Redirect to a success page
        return redirect()->route('customer.dashboard');
    }
}
