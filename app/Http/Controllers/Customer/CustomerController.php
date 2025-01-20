<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a Customer model
use App\Models\Country;
use App\Models\County;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\UserView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
    
        if ($user->role_id == 1) {
            $roleText = 'Student';
        } elseif ($user->role_id == 2) {
            $roleText = 'Tutor';
        } else {
            $roleText = 'Unknown Role';
        }

        if($user->role_id == 1){
            return view('customer.student_dashboard', compact('user', 'roleText'));
        }else{
            return view('customer.dashboard', compact('user', 'roleText'));
        } 
    }
    public function create($step=1)
    {
        $request = request();
        $countries = Country::get()->pluck('name','id');
        $countyies = County::get()->pluck('name','id'); // Fetch all records from the `county` table
        //dd($countries, $countyies);
        $formData = $request->session()->get('registration_form', []);

        return view('auth.register', compact('formData', 'step', 'countries', 'countyies'));
    }
    public function store($step)
    {
        $request = request();
        // Validation rules for each step
        $rules = [];
        switch ($step) {
            case 1:
                $request->merge([
                    'role' => strtolower($request->role),
                ]);
                $rules = [
                    'role' => 'required|in:tutor,student',
                    'username' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:6|confirmed',
                ];
                break;
            case 2:
                $rules = [
                    'title' => 'required|string|max:255',
                    'gender' => 'required|in:male,female',
                    'firstName' => 'required|string|max:255',
                    'lastName' => 'required|string|max:255',
                    'address1' => 'required|string|max:255',
                    'address2' => 'nullable|string|max:255',
                    'town' => 'required|string|max:255',
                    'county' => 'nullable|string|max:255',
                    'country' => 'required|string|max:255',
                    'postcode' => 'required|string|max:15',
                    'phoneNumber' => 'required|string|max:15',
                    'dobYear' => 'required|integer',
                    'dobMonth' => 'required|integer',
                    'dobDay' => 'required|integer',
                ];
                break;
            case 3:
                $rules = [
                    'language' => 'required|string|max:255',
                    'distance' => 'required|in:0,1,2,3,4,5,8,10,12,15,20,30,50',
                    'yourbio' => 'nullable|string|max:1000',
                    'yourexperience' => 'nullable|string|max:1000',
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

        // Retrieve all data from the session if we're at the last step (step 3)
        if ($step == 3) {
            // Retrieve data from all steps
            $allStepsData = [];
            for ($i = 1; $i <= 3; $i++) {
                $allStepsData[$i] = $request->session()->get('registration_form.' . $i);
            }
        
            // Combine all the step data into one array for saving in the user table
            $userData = array_merge(
                $allStepsData[1], // Data from step 1 (role, username, email, password)
                $allStepsData[2], // Data from step 2 (personal info)
                $allStepsData[3]  // Data from step 3 (language, distance, bio, experience)
            );
        
            // Optionally, you can hash the password here if you're saving it to the database
            //$userData['password'] = hash($userData['password']);
        
            // Create a new user record or update if needed
            $user = User::create([
                'role_id' => ($userData['role'] == 'Tutor') ? 2 : 1,
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']), 
                'title' => $userData['title'],
                'gender' => $userData['gender'],
                'firstname' => $userData['firstName'],
                'lastname' => $userData['lastName'],
                'address' => trim($userData['address1'] . ' ' . $userData['address2']),
                'town' => $userData['town'],
                'county' => $userData['county'],
                'country' => $userData['country'],
                'postcode' => $userData['postcode'],
                'mobile' => $userData['phoneNumber'],
                'dob_year' => $userData['dobYear'],
                'dob_month' => $userData['dobMonth'],
                'dob_day' => $userData['dobDay'],
                'language' => $userData['language'],
                'distance' => $userData['distance'],
                'bio' => $userData['yourbio'],
                'experience' => $userData['yourexperience'],
            ]);

            //dd($user);
            // Flash message
              session()->flash('message', 'Registration successful! The admin will review your profile shortly.');
            // Optionally, you can clear the session data after saving
            $request->session()->forget('registration_form');
        
            // Redirect or return a response
            return redirect()->route('login');
        }
    }

    public function viewStudent($username)
    {
        $userView = new UserView();
        // Render the user's profile
        $user = User::where('username', $username)->first();
        $userView->setViewCount($user->id);
        return view('customer.customer_count', compact('user'));
    }
    public function viewProfile()
    {
        $customer = Auth::user(); 
        return view('customer.student_dashboard', compact('customer'));
    }
    public function updateProfile(Request $request)
    {
        // Validate the form input
        $request->validate([
            'comments_about_tuition' => 'nullable|string|max:6500',
            'availability' => 'nullable|string|max:6500',
            'distance' => 'required|integer',
        ]);

        // Fetch the logged-in user
        $customer = Auth::user(); 

        // Update the user's profile data
        $customer->update([
            'comments_about_tuition' => $request->input('comments_about_tuition'),
            'availability' => $request->input('availability'),
            'distance' => $request->input('distance'),
        ]);

        // Redirect back with a success message
        return redirect()->route('customer.profile.view')->with('success', 'Profile updated successfully!');
    }

    public function showProfileStats()
    {
        $userId = Auth::user();
        $dailyViews = getUserViewCounts($userId);
        return view('customer.profile.view', compact('dailyViews'));
    }
    public function mySubject()
    {
        $userId = Auth::user();
        $dailyViews = getUserViewCounts($userId);
        //dd($dailyViews);
        return view('customer.student_subject', compact('dailyViews'));
    }
    public function addsubject()
    {
        $courses_list = $this->getCourses();
        $courses_list_level = $this->getCoursesLevel();
        return view('customer.student_add_subject', compact('courses_list','courses_list_level'));
    }
}