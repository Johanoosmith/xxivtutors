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
use App\Models\Subject;
use App\Models\Student;
use App\Services\StripeService;
use Illuminate\Support\Facades\Notification;


class CustomerController extends Controller
{
	
	protected $stripeService;
	
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
            return view('tutor.dashboard', compact('user', 'roleText'));
        } 
    }
    public function create($step=1)
    {
		/*
		For Testing:
		Notification::route('mail', 'khelesh.mehra@dotsquares.com')->notify(new CustomEmailNotification('khelesh.mehra@dotsquares.com', [], 'CUSTOMER_REGISTRATION'));
		*/
		
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
                    //'county' => 'nullable|string|max:255',
                    'county' => 'required|string|max:255',
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
        
            $user = User::create([
                'role_id' => ($userData['role'] == 'Tutor') ? config('constants.ROLE.TUTOR') : config('constants.ROLE.STUDENT'),
                'username' => $userData['username'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']), 
                'gender' => $userData['gender'],
                'firstname' => $userData['firstName'],
                'lastname' => $userData['lastName'],
                'address' => trim($userData['address1'] . ' ' . $userData['address2']),
                'postcode' => $userData['postcode'],
                'mobile' => $userData['phoneNumber'],
				'dob_year' => $userData['dobYear'],
                'dob_month' => $userData['dobMonth'],
                'dob_day' 	=> $userData['dobDay'],
            ]);
            
            $student = Student::create([
                'user_id' => $user->id,
                'title' => $userData['title'],
                'town' => $userData['town'],
                'county' => $userData['county'],
                'country' => $userData['country'],	
                'language' => $userData['language'],
                'distance' => $userData['distance'],
                'bio' => $userData['yourbio'],
                'experience' => $userData['yourexperience'],
            ]);
            // Send email
            $userArray = $user->toArray(); 

            // Add username manually (not needed because it's already in $userArray)
            $userArray['username'] = $user->username;
            //dd($userArray);
            $emailSent = sendMail($user->email, $userArray, 'CUSTOMER_REGISTRATION');
            
            if($user && $user->role_id == config('constants.ROLE.TUTOR')){
				$this->stripeAccountCreate($user->id);
			}

            //dd($user);
            // Flash message
              session()->flash('message', 'Registration successful! The admin will review your profile shortly.');
            // Optionally, you can clear the session data after saving
            $request->session()->forget('registration_form');
        
            // Redirect or return a response
            return redirect()->route('login');
        }
    }
	
	public function stripeAccountCreate($user_id){
		
		$this->stripeService = new StripeService();
		
		$user   = User::where('id',$user_id)->with(['tutor'])->first()->toArray(); 
		
		$country= \App\Models\Country::where('id',$user['tutor']['country'])->first();
		$county	= \App\Models\County::where('id',$user['tutor']['county'])->first();
		
		$data = [
			'first_name'=>$user['firstname'],
			'last_name' =>$user['lastname'],
			'email' 	=> $user['email'],
			'phone'		=> $user['mobile'],
			'dob_day'	=> $user['dob_day'],
			'dob_month' => $user['dob_month'],
			'dob_year'	=> $user['dob_year'],
			'address_line1' => $user['address'],
			'city' 			=> (!empty($user['tutor']['town'])) ? $user['tutor']['town'] : 'Eastbourne',
			'state' 		=> (!empty($county['name'])) ? $county['name'] : 'Avon',
			'postal_code' 	=> $user['postcode'],
			'company'		=> $user['username'],
			'country' 		=> !empty($country) ? $country->code2l : 'GB',
		];
		
		
		$response	= $this->stripeService->createAccount($data);
		
		if($response['status'] == 1){
			$link_response	= $this->stripeService->accountLinks($response['data']->id);
			
			if($link_response['status'] == 1){
				$paymentGatway = new \App\Models\PaymentGateway();
				
				$paymentGatway->user_id			= $user_id;
				$paymentGatway->account_id		= $response['data']->id;
				$paymentGatway->email 			= $user['email'];
				$paymentGatway->currency 		= 'GBP';
				$paymentGatway->account_link_url= $link_response['data']['url'];
				$paymentGatway->save();
				
				$data['url'] = $link_response['data']['url'];
				
				
				sendMail($user['email'], $data, 'STRIPE_REGISTRATION');
			}
		}
		
		return redirect()->route('login');
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
        
        $student = $customer->student;
      
        return view('customer.student_dashboard', compact('customer','student'));
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
     
        $student = $customer->student;
        // Step 4: Update the Student model (if it exists)
      if ($student) {
        $student->update([
            'comments_about_tuition' => $request->input('comments_about_tuition'),
            'availability' => $request->input('availability'),
            'distance' => $request->input('distance'),
        ]);
    }
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
    public function personalinfo()
    { 
        $personalinfo = Auth::user();
        $student = $personalinfo->student;
        $countyies = County::get()->pluck('name','id');
        return view('customer.student_personalinfo', compact('personalinfo','student','countyies'));
    }
    public function personalinfoupdate()
    { 
        $request = request();
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile' => 'required|string|max:15',
            'postcode' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'town' => 'required|string|max:255',
            'county' => 'required|exists:county,id',
        ]);
        
      // Step 2: Fetch the authenticated user and their associated student
      $user = Auth::user();
      $student = $user->student;
      // Step 3: Update the User model
      $user->update([
          'email' => $validatedData['email'],
          'lastname' => $validatedData['lastname'],
          'address' => $validatedData['address'],
          'postcode' => $validatedData['postcode'],
          'mobile' => $validatedData['mobile'],
      ]);
      // Step 4: Update the Student model (if it exists)
      if ($student) {
          $student->update([
              'title' => $validatedData['title'],
              'town' => $validatedData['town'],
              'county' => $validatedData['county'],
          ]);
      }
      return redirect()->back()->with('success', 'Personal information updated successfully!');
    }
    public function studpassword()
    { 
        $studpassword = Auth::user();
        return view('customer.student_password', compact('studpassword'));
    }
    public function studpasswordupdate()
    {   
        $request = request();
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        // Step 2: Fetch the authenticated user and their associated student
        $user = Auth::user();
          // Check if the current password is correct
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        // Update the password
        $user->update([
            'password' => Hash::make($validatedData['password']),
        ]);
        return back()->with('success', 'Password updated successfully!');
    }
    public function showUploadForm()
    {
        $student = Auth::user(); // Assuming you are using Auth for students
        return view('customer.student_profilephoto', compact('student'));
    }
    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
        ]);
        $user = Auth::user(); // Get the authenticated user
        $file = $request->file('profile_image');

        // Store the file in the "profile_images" directory and get its path
        $path = $file->store('profile_images', 'public');

        // Optionally, delete the old photo if it exists
        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }
        // Save the new photo path in the user's record
        $user->profile_image = $path;
        $user->save();
        return back()->with('success', 'Profile photo uploaded successfully!');
    }
    public function show($id)
    {
        
        $user = User::where('role_id', config('constants.ROLE.STUDENT'))->findOrFail($id);
        $student = $user->student;
        //$subjects = \App\Models\SubjectStudent::getStudentSubjectByUser($user->id);

        $subjects =  \App\Models\SubjectStudent::with(['subject', 'level'])
        ->where('user_id', $user->id)
        ->get();

        // Get all unique levels dynamically
        $levels = $subjects->pluck('level.title')->unique()->sort()->values()->toArray();

        // Group subjects by name and assign levels
        $groupedSubjects = [];

        foreach ($subjects as $subject) {
            $title = $subject->subject->title; // Get subject name
            $level = $subject->level->title; // Get level title

            if (!isset($groupedSubjects[$title])) {
                // Initialize subject row with empty levels
                $groupedSubjects[$title] = [
                    'title' => $title,
                ];

                // Set all levels to '-'
                foreach ($levels as $lvl) {
                    $groupedSubjects[$title][$lvl] = '-';
                    
                }
            }
            // Assign checkmark to the correct level
            $groupedSubjects[$title][$level] = '✔';
        }
            $levels =  \App\Models\SubjectStudent::with('level')
            ->where('user_id', $user->id)->get()->pluck('level.title')->unique()->sort()->values()->toArray();       
            //dd($levels);

            
            return view('customer.student_profile', compact('user','student','subjects','levels', 'groupedSubjects')); // Pass user data to the profile view
    }
    public function studmyclients()
    { 
        $courses_list = $this->getCourses();
        $courses_list_level = $this->getCoursesLevel();
        return view('customer.student_myclient', compact('courses_list'));
    }
    public function studprivacy()
    { 
        $courses_list = $this->getCourses();
        $courses_list_level = $this->getCoursesLevel();
        return view('customer.student_privacy', compact('courses_list'));
    }
    public function noaccess()
    { 
       return view('customer.student_noaccess');
    }
    public function tags()
    {
        $user = Auth::user();
        $tags = $user->tags ?? []; // Ensure an empty array if no tags exist
        return view('customer.student_tags', compact('tags'));
    }
    public function history()
    {
        $user = Auth::user();
        $dailyViews = getUserViewCounts($user);
        $user_views = UserView::where('user_id', $user->id)
            ->with(['user:id,firstname,lastname', 'viewer:id,firstname,lastname,created_at'])
            ->select('viewer_id')  // Add this to select the viewer_id
            ->get();
       //dd( $user_views);
        return view('customer.student_history', compact('dailyViews', 'user_views', 'user'));
    }

}