<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscriptions,email', // Ensure email is unique in the subscriptions table
            'role' => 'required|in:tutor,student', // Ensure role is either 'tutor' or 'student'
        ]);
         
        // Check if the email already exists (not needed because of the unique validation)
        $existingSubscriber = Subscription::where('email', $request->email)->first();
        if ($existingSubscriber) {
            // Email already registered, redirect back with an error message
            return redirect()->back()->with('s_error', 'This email address is already registered.');
        }
    
        // If email doesn't exist, proceed with saving the new subscriber
        $subscriber = new Subscription();
        $subscriber->name = $request->name;
        $subscriber->email = $request->email;
        $subscriber->role = $request->role;
        $subscriber->save();
    
        // Redirect back to the same page with a success message and retain the form inputs
        return redirect()->back()
                         ->with('s_success', 'Thank you for subscribing!')
                         ->withInput();  // This will retain the form values
    }
    
}
