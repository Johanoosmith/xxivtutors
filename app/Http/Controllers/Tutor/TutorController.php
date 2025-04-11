<?php

namespace App\Http\Controllers\Tutor;

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
use App\Models\Student;
use App\Models\Language;
use App\Models\Tutor;
use App\Models\Verification;
use App\Models\Qualification;
use App\Models\UserQualification;
use App\Models\Headline;
use App\Models\Availability;
use App\Models\Enquiry;
use App\Models\Booking;
use App\Models\EnquiryComment;
use App\Models\Article;
use App\Models\Reference;

class TutorController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently logged-in user
        $userId = $user->id;
        $tutorsdata = DB::table('tutors')->where('user_id', $userId)->get();
        $languages = Language::orderBy('name', 'ASC')->select('name', 'id')->get()->pluck('name', 'id');
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
            return view('tutor.dashboard', compact('user', 'roleText', 'tutorsdata','languages'));
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
                    'title'		=> 'required|string|max:255',
                    'gender'	=> 'required|in:male,female',
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
                'gender' => $userData['gender'],
                'firstname' => $userData['firstName'],
                'lastname' => $userData['lastName'],
                'address' => trim($userData['address1'] . ' ' . $userData['address2']),
                'postcode' => $userData['postcode'],
                'mobile' => $userData['phoneNumber'],
				'dob_year' => $userData['dobYear'],
                'dob_month' => $userData['dobMonth'],
                'dob_day' => $userData['dobDay'],
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
        $user = Auth::user(); // Authenticated user
        $userId = $user->id;
        $tutorsdata = DB::table('tutors')->where('user_id', $userId)->get();
        $languages = Language::orderBy('name', 'ASC')->select('name', 'id')->get()->pluck('name', 'id');
        //dd($tutorsdata);
        return view('tutor.dashboard', compact('user','tutorsdata','languages'));
    }
    public function updateTutorprofile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'short_description' => 'nullable|string|max:6500',
            'availability' => 'nullable|string',
            'online_teaching_experience' => 'nullable|string',
            'your_experience' => 'nullable|string',
            'language' => 'nullable|exists:languages,id',
            'distance' => 'nullable|numeric|min:0|max:50',
        ]);
    
        // Find the tutor and ensure it belongs to the authenticated user
        $tutor = Tutor::findOrFail($id);
    
        // Update tutor fields
        $tutor->short_description = $validatedData['short_description'];
        $tutor->availability = $validatedData['availability'];
        $tutor->online_teaching_experience = $validatedData['online_teaching_experience'];
        $tutor->your_experience = $validatedData['your_experience'];
        $tutor->language = $validatedData['language'];
        $tutor->distance = $validatedData['distance'];
    
        // Save changes to the database
        $tutor->save();

        return redirect()->back()->with('success', 'Tutor updated successfully');
    }
    public function profilequalification()
    {
        $tutor = Auth::user(); 
        $userQualifications = UserQualification::with('qualification')->where('user_id', $tutor->id)->get();
        // dd($userQualifications);
        return view('tutor.tutor_qualification', compact('userQualifications'));
    }
    public function newqualification()
    {
        $qualifications = Qualification::where('status', 1)
                        ->select('qtype', 'qualification','id')
                        ->orderBy('qtype')
                        ->orderBy('qualification')->orderBy('id')
                        ->get();

        return view('tutor.tutor_newqualification', compact('qualifications'));
    }
    public function newqualificationstore(Request $request)
    {
            $validated = $request->validate([
                'qtype' => 'required|string|max:255',
                'qualification_id' => 'required|integer|exists:qualifications,id', // Ensure it's an integer and exists in the qualifications table
                'institute_name' => 'nullable|string|max:255',
                'subject' => 'nullable|string|max:255',
                'grade' => 'nullable|string|max:255',
                'qyear' => 'nullable|digits:4',
                'qdocument' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
            ]);
            
        // dd($validated);  // Check if this reaches
            
            $filePath = $request->hasFile('qdocument') 
                ? $request->file('qdocument')->store('qualification_files', 'public')
                : null;

            UserQualification::create([
                'user_id' => Auth::id(),
                'qtype' => $request->qtype,
                'qualification_id' => $request->qualification_id,
                'institute_name' => $request->institute_name,
                'subject' => $request->subject,
                'grade' => $request->grade,
                'qyear' => $request->qyear,
                'qdocument' => $filePath,
                'status' => 1,
            ]);
            return redirect()->route('tutor.qualification')->with('success', 'Qualification added successfully!');
    }
    public function edit($id)
    {
        $qualification = UserQualification::findOrFail($id);
    
        // Fetching qualification list
        $qualification_list = Qualification::where('status', 1)
            ->select('qtype', 'qualification', 'id')
            ->orderBy('qualification', 'ASC')
            ->get()
            ->pluck('qualification', 'id');
    
        // Fetching qdocument from the UserQualification model
        $qdocument = $qualification->qdocument; 
    
        return view('tutor.tutor_qualification_edit', compact('qualification', 'qualification_list', 'qdocument'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'qtype' => 'required|string|max:255',
            'qualification_id' => 'required|integer',
            'institute_name' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'qyear' => 'nullable|digits:4',
            'qdocument' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ],[
            'qdocument.required' => 'Please upload a document.',
            'qdocument.mimes' => 'The document must be a file of type: pdf, doc, docx.',
            'qdocument.max' => 'The document size may not exceed 2MB.',
        ]);

    
        $qualification = UserQualification::findOrFail($id);
    
        $qualification->qtype = $request->qtype;
        $qualification->qualification_id = $request->qualification_id;
        $qualification->institute_name = $request->institute_name;
        $qualification->subject = $request->subject;
        $qualification->grade = $request->grade;
        $qualification->qyear = $request->qyear;
    
        if ($request->hasFile('qdocument')) {
            $qualification->qdocument = $request->file('qdocument')->store('qualification_files', 'public');
        }
        $qualification->save();
        $qualifications = Qualification::where('status', 1)
                        ->select('qtype', 'qualification','id')
                        ->orderBy('qtype')
                        ->orderBy('qualification')->orderBy('id')
                        ->get();
                        return redirect()->back()
                        ->with('success', 'Qualification updated successfully')
                        ->with('qualifications', $qualifications);
    }
    public function qualificationdestroy($id)
    {
        $qualification = UserQualification::find($id);

        if (!$qualification) {
            return redirect()->back()->with('error', 'Qualification not found.');
        }
        $qualification->delete();

        return redirect()->route('tutor.qualification')->with('success', 'Qualification deleted successfully.');
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
    public function personalinfo()
    { 
        $personalinfo = Auth::user();
        $student = $personalinfo->student;
        $countyies = County::get()->pluck('name','id');
        $countries = Country::get()->pluck('name','id');
        return view('tutor.tutor_personalinfo', compact('personalinfo','student','countyies', 'countries'));
    }

    public function personalinfoupdate()
    { 
        $request = request();
        $validatedData = $request->validate([
            'title'    => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . Auth::id(),
            'mobile'   => 'required|string|max:15',
            'postcode' => 'nullable|string|max:10',
            'address'  => 'nullable|string',
            'town'     => 'required|string|max:255',
            'county'   => 'required|exists:county,id',
        ]);
        
      
        $user = Auth::user();
        $student = $user->student;
        
        $user->update([
            'email' => $validatedData['email'],
            'lastname' => $validatedData['lastname'],
            'address' => $validatedData['address'],
            'postcode' => $validatedData['postcode'],
            'mobile' => $validatedData['mobile'],
        ]);
      
      
        $user->tutor->update([
            'title'  => $validatedData['title'],
            'town'   => $validatedData['town'],
            'county' => $validatedData['county'],
        ]);
      
      return redirect()->back()->with('success', 'Personal information updated successfully!');
    }

    public function studpassword()
    { 
        $studpassword = Auth::user();
        return view('tutor.tutor_password', compact('studpassword'));
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
        return view('tutor.tutor_profilephoto', compact('student'));
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
    public function show($user_id)
    {
        
        $user = User::findOrFail($user_id); // Fetch the user by ID
        $tutor = $user->Tutor;

        $inPlaceSubjects = $this->getSubjectLevelWise($user_id, 1);
        $onlineSubjects = $this->getSubjectLevelWise($user_id, 2);

        $availability       = Availability::where('user_id',$user_id)->get();
        $userQualifications = UserQualification::where('user_id',$user_id)
                                    ->with(['qualification'])
                                    ->orderBy('qyear','DESC')
                                    ->get();
        
        return view('tutor.tutor_profile', compact('user','tutor','inPlaceSubjects','onlineSubjects','availability','userQualifications')); // Pass user data to the profile view
    }

    public function getSubjectLevelWise($user_id, $type = 1)
    {
        $subjects =  \App\Models\SubjectTutor::with(['subject', 'level'])
        ->where('user_id', $user_id)
        ->where('type' , $type)
        ->get();

        //dd($subjects);

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
            $groupedSubjects[$title][$level] = $subject->lesson_rate;
        }
        
        $levels =  \App\Models\SubjectTutor::with('level')
                                        ->where('user_id', $user_id)
                                        ->get()
                                        ->pluck('level.title')
                                        ->unique()
                                        ->sort()
                                        ->values()->toArray(); 

        $response = [
            'subjects'=>$groupedSubjects,
            'levels'=>$levels
        ];
        
        return $response;
    }


    public function tutorMyClients(Request $request)
    { 
        $user = Auth::user();
        $paidBookings = Booking::where('tutor_id',$user->id)
                            ->whereHas('payments', function ($query) {
                                $query->where('status', 'paid');
                            })->with(['student','booking_enquiry'])->get();
        
        
        /*
        $enquiries = Enquiry::whereIn('id', function ($query) use ($user) {
            $query->selectRaw('MAX(id)')
                  ->from('enquiries')
                  ->where('sender_id', $user->id)
                  ->groupBy('receiver_id');
        })
        ->with(['receiver'])
        ->latest()
        ->get();
        */
            
        return view('tutor.tutor_myclient', compact('paidBookings'));
    }
    public function turorContract($id)
    { 
        $user = Auth::user();
        $booking = Booking::where('id', $id)
            ->with(['tutor'=>['tutor'],'student'])
            ->first();

        return view('tutor.turor_contract',compact('booking'));
    }
    public function tutorprivacy()
    { 
        $courses_list = $this->getCourses();
        $courses_list_level = $this->getCoursesLevel();
        return view('tutor.tutor_privacy', compact('courses_list'));
    }
    public function verification()
    {   
        $userID = Auth::id();

        $verification = Verification::where('user_id', $userID)->first();
        $references   = Reference::where('user_id', $userID)->get();
        

        if ($references->isEmpty()) {
            $references = collect(); // Ensure it's an empty collection instead of null/false
        }

        $statusLabels = [
            1 => 'Approved',
            2 => 'Pending',
            3 => 'Rejected',
        ];
        $user = Auth::user();
        //dd($tutordata);

        return view('tutor.tutor_verification', compact('user','verification', 'statusLabels','references'));
    }
    public function proofidentity()
    {   $user = Auth::user();
        //dd($user);
        return view('tutor.tutor_proofidentity', compact('user'));
    }
    public function proofstore(Request $request)
    {
        $request->validate([
            'document_type' => 'required|in:passport,national_id,driver_license',
            'lastname_on_doc' => 'required|string|max:255',
            'firstname_on_doc' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'expire_date' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);
        $userID = Auth::id();

        $filePath = $request->hasFile('file') 
            ? $request->file('file')->store('identification_files', 'public') 
            : null;
    
        // Update existing record or create a new one
        Verification::updateOrCreate(
            ['user_id' => $userID], // Condition to check existing data
            [
                'document_type' => strtolower(trim($request->document_type)),
                'lastname_on_doc' => $request->lastname_on_doc,
                'firstname_on_doc' => $request->firstname_on_doc,
                'othername_on_doc' => $request->othername_on_doc,
                'country_id' => $request->country_id,
                'expire_date' => $request->expire_date,
                'file' => $filePath ?? Verification::where('user_id', $userId)->value('file'),
                'status' => 2, // Pending by default
            ]
        );
        return redirect()->route('tutor.verification')->with('success', 'Proof of Identification Submitted Successfully');
       
    }
    public function proofdbs()
    {   
        $userID = Auth::id();

        $verification = Verification::where('user_id', $userID)->first();

        $statusLabels = [
            1 => 'Approved',
            2 => 'Pending',
            3 => 'Rejected',
        ];
        $user = Auth::user();
        //dd($tutordata);

        return view('tutor.tutor_proofdbs', compact('user','verification', 'statusLabels'));
    }
    public function proofdbssubmit(Request $request)
    {
        // Validate the request
        $request->validate([
            'dbs_number' => 'required|string|max:255',
            'expire_date' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);
    
        // Handle file upload if present
        $filePath = $request->hasFile('file') 
            ? $request->file('file')->store('identification_files', 'public') 
            : null;
    
        // Insert new record into the Verification table
        Verification::create([
            'user_id' => Auth::id(), // Assigning the current authenticated user
            'dbs_number' => $request->dbs_number,
            'expire_date' => $request->expire_date,
            'file' => $filePath,
            'status' => 2, // Default status is 'Pending'
        ]);
    
        return redirect()->route('tutor.verification')->with('success', 'Proof of Identification Submitted Successfully');
    }
    public function myavailability(Request $request)
    {
        $user = Auth::user();
        $availabilities = Availability::where('user_id', $user->id)
            ->get()
            ->reduce(function ($carry, $item) {
                $days = explode(',', $item->days);
                foreach ($days as $day) {
                    $carry[$day][$item->time_slot] = true;
                }
                return $carry;
            }, []);
        return view('tutor.availability.index', compact('availabilities'));
    }
    
    public function updateAvailability(Request $request)
    {
        $user = Auth::user();
    
        // Initialize an array to store availability grouped by time slot
        $availabilityData = [];
    
        // Loop through availability data grouped by time slot
        foreach (['Morning', 'Afternoon', 'After School', 'Evening'] as $slot) {
            $selectedDays = [];
    
            // Check each day if the time slot is selected
            foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day) {
                if (isset($request->availability[$day][$slot])) {
                    $selectedDays[] = $day;
                }
            }
    
            // If the time slot is selected for any day, store it
            if (!empty($selectedDays)) {
                $availabilityData[] = [
                    'user_id'   => $user->id,
                    'time_slot' => $slot,
                    'days'      => implode(',', $selectedDays), // Store as comma-separated string
                    'available' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
    
        // Remove old availability records for the user
        Availability::where('user_id', $user->id)->delete();
    
        // Insert the new structured data
        Availability::insert($availabilityData);
    
        return redirect()->back()->with('success', 'Availability updated successfully!');
    }
    public function headlines()
    {
        $userid = Auth::id(); 
        // Check if the tutor exists and belongs to the authenticated user
        $tutor = Tutor::where('id',  $userid)->where('user_id', $userid)->firstOrFail();

        // Fetch the headline for this tutor, if it exists
        $headline = Headline::where('user_id', $userid)->first();

        return view('tutor.headlines.index', compact('tutor', 'headline'));
    }
    public function headlinesupdate(Request $request)
    {
        $request->validate([
            'headline_text' => 'required|string|max:255',
        ]);
    
        $userId = Auth::id();
    
        // Find or create the headline record for the user
        $headline = Headline::firstOrNew(['user_id' => $userId]);
        $headline->headline_text = $request->input('headline_text');
        $headline->save();
    
        return redirect()->back()->with('success', 'Headline updated successfully.');
    }
    public function foundme(Request $request)
    {
        $user = Auth::user();
        $dailyViews = getUserViewCounts($user);
        $user_views = UserView::where('user_id', $user->id)
            ->with(['user:id,firstname,lastname', 'viewer:id,firstname,lastname,created_at'])
            ->select('viewer_id')  // Add this to select the viewer_id
            ->get();
       //dd( $user_views);
        return view('tutor.foundme.index', compact('dailyViews', 'user_views', 'user'));
    }


    public function enquiries(Request $request)
    {
        $user = Auth::user();

        $enquiries = Enquiry::where('sender_id',$user->id)
                        ->whereHas('enquiry_comments') 
                        ->with(['enquiry_comments' => function ($query) {
                            $query->latest()->limit(1);  
                        }])
                        ->get();

        /*        
        $enquiries = Enquiry::where(function($query) use ($user) {
							$query->where('receiver_id', $user->id)
								  ->orWhere('sender_id', $user->id);
						})
						->with(['sender', 'receiver'])
						->orderBy('created_at', 'DESC')
						->get();
		*/

        return view('tutor.enquiries.index', compact('enquiries'));
    }

    public function showEnquire($enquiry_id, $booking_id=NULL)
    {
        $user = Auth::user();

        // Fetch all chats between the logged-in tutor and the specific sender
        $enquiry = Enquiry::where('id', $enquiry_id)
                        ->with([
                                'sender'=>['tutor'],
                                'receiver'=>['student'],
                                'booking_enquiry',
                                'subject_tutor'=>['subject','level']
                            ])
						->orderBy('created_at', 'asc')
                        ->first();              

        if(empty($booking_id)){
            $booking_id = $enquiry->booking_enquiry[0]->booking_id;
        }

        $booking = Booking::where('id',$booking_id)->first();

        $messages = $this->getChatMessages($enquiry_id);
        
        $sender = User::find($enquiry_id);
        return view('tutor.enquiries.chats', compact('enquiry','sender','booking','messages'));
    }
    public function sendEnquiryMessage(Request $request)
    {
        // $request->validate([
        //     'content' => 'required|string|max:5500',
        //     'enquiry_id' => 'required|exists:enquiries,id',
        // ]);

        $user = Auth::user(); // Fetch the authenticated user
        if(empty($request->content) || empty($request->enquiry_id)){
            return redirect()->back();
        }

        $enquiry = Enquiry::findOrFail($request->enquiry_id); // Fetch enquiry
        
        $enquiryCommentCount = EnquiryComment::where('enquiry_id', $request->enquiry_id)
                            ->where('sender_id', $user->id)
                            ->count();
        
        if($enquiryCommentCount > config('constants.SITE.ENQUIRY_MESSAGE_LIMIT')){
            // If the limit is exceeded, redirect back with an error message
            return redirect()->back()->with('error', 'You have exceed enquiry '.config('constants.SITE.ENQUIRY_MESSAGE_LIMIT').' message limit ');
        }
        
        $last_enquiry_comment = EnquiryComment::where('enquiry_id', $request->enquiry_id)->orderBy('id','DESC')->first();
        
        
        $parent_id = (!empty($last_enquiry_comment->id)) ? $last_enquiry_comment->id : 0;
        
        EnquiryComment::create([
            'parent_id'     =>  $parent_id, 
            'enquiry_id'    => $enquiry->id,
            'sender_id'     => Auth::id(),
            'receiver_id'   => $enquiry->receiver_id,
            'content'       => $request->content,
            'status'        => 'unread'
        ]);
        
        //return redirect()->route('tutor.enquiries.chats', ['enquiry_id' => $enquiry->id])
        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function getChatMessages($enquiryId)
    {
        $messages = EnquiryComment::where('enquiry_id', $enquiryId)
        ->orderBy('created_at', 'DESC') // Ensure proper sequence
        ->get();

        return $messages;
    }

    public function enquiryClose(Request $request, $enquiry_id){

        $auth_user  = Auth::user(); // Fetch the authenticated user
        $enquiry    = Enquiry::where('sender_id',$auth_user->id)
                            ->where('status',1)
                            ->findOrFail($enquiry_id); // Fetch the enquiry  
        
        $enquiry->status = 3; // Update the status to closed
        $enquiry->action_by = $auth_user->id;
        $enquiry->save();
        return redirect()->back()->with('success', 'Enquiry has been closed.');
    }

    public function enquiryReport(Request $request, $enquiry_id){

        $auth_user  = Auth::user(); // Fetch the authenticated user

        $enquiry = Enquiry::where('sender_id',$auth_user->id)
                            ->where('status',1)
                            ->findOrFail($enquiry_id); // Fetch the enquiry  

                            
        if($request->isMethod('post')){
            
            $request->validate([
                'report_reason' => 'required|string|max:5500',
            ]);
     
            $enquiry->report_reason = $request->report_reason;
            $enquiry->status = 2; // Update the status to reported
            $enquiry->action_by = $auth_user->id;
            $enquiry->save();
                     
            return redirect()->route('tutor.enquiries.enquiries')->with('success', 'Enquiry has been reported.');
        }
        

        return view('tutor.enquiries.report', compact('enquiry', 'enquiry_id'));
    }

    public function tags()
    {
        $user = Auth::user();
        $tags = $user->tags ?? []; // Ensure an empty array if no tags exist
        return view('tutor.tags.index', compact('tags'));
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
        return view('tutor.history', compact('dailyViews', 'user_views', 'user'));
    }
    public function articles()
    {
        $articles = Article::where('user_id', Auth::id())->latest()->paginate(10);

        //$articles = Article::where('user_id', Auth::id())->get();
        return view('tutor.articles.index', compact('articles'));
    }
    public function addqarticles()
    {
        $courses = Course::getCouseList();
       return view('tutor.articles.add', compact('courses'));
    }
    public function articlesstore(Request $request)
    {
        // Validate input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id'   => 'required|exists:courses,id',
            'subject_id'  => 'required|exists:subjects,id',
            'content'     => 'required|string',
        ]);
        $user = Auth::user();
        $user_id = $user->id;

        // Store new article
        Article::create([
            'user_id'    => $user_id, // Authenticated tutor
            'title'       => $request->title,
            'description' => $request->description,
            'course_id'   => $request->course_id,
            'subject_id'  => $request->subject_id,
            'content'     => $request->content,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Article added successfully!');
    }
    public function articlesedit($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('tutor.articles.edit', compact('article'));
    }
    public function articlesupdate(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'content'     => 'required|string',
        ]);

        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->update([
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content,
        ]);

        return redirect()->route('tutor.articles.index')->with('success', 'Article updated successfully!');
    }
    public function articlesdestroy($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->delete();

        return redirect()->route('tutor.articles.index')->with('success', 'Article deleted successfully!');
    }
    public function addrefernce() {
        return view('tutor.tutor_addrefernce');
    }
    public function submitreference(Request $request)
    {
        // Check if reference array exists
        if (!is_array($request->reference) || empty($request->reference)) {
            return back()->with('error', 'No valid references provided.');
        }
    
        // Filter out empty rows
        $validReferences = array_filter($request->reference, function ($ref) {
            return !empty($ref['firstname']) && !empty($ref['lastname']) &&
                   !empty($ref['email']) && !empty($ref['mobile']) &&
                   !empty($ref['profession']);
        });
    
        if (empty($validReferences)) {
            return back()->with('error', 'No valid references provided.');
        }
    
        // Validate only provided data
        $request->validate([
            'reference.*.email' => 'email',
            'reference.*.mobile' => 'digits_between:10,15',
        ], [
            'reference.*.email.email' => 'Please enter a valid email address.',
            'reference.*.mobile.digits_between' => 'Mobile number must be between 10 and 15 digits.',
        ]);
        foreach ($validReferences as $ref) {
            // Create reference record
            $newReference = Reference::create([
                'user_id' => Auth::id(),
                'first_name' => $ref['firstname'],
                'last_name' => $ref['lastname'],
                'email' => $ref['email'],
                'mobile' => $ref['mobile'],
                'profession' => $ref['profession'],
                'sent_date' => now(),
                'status' => 'pending',
                'mail_send' => 0,
            ]);
        
            // Convert model to array before passing to mail function
            $referenceArray = $newReference->toArray();
            $referenceArray['username'] = $newReference->user->username; // Add username to the array

            // Send email
            $emailSent = sendMail($newReference->email, $referenceArray, 'REFERENCE_MAIL');
        
            // Update mail_send flag if email was sent successfully
            if ($emailSent) {
                $newReference->update(['mail_send' => 1]);
            }
        }
        //Mail::to($reference->email)->send(new ReferenceEmail($reference));
        return redirect()->back()->with('success', 'References added successfully!');
    }
    public function resendEmail($id)
    {
        $reference = Reference::findOrFail($id);
        $referenceOwner = $reference->user->username;

 
        $data = [
            'firstname' => $reference->first_name, // Access from $reference, not $this
            'username' => $reference->user->username,
        ];
    
        // Resend the email
        sendMail($reference->email, $data, 'VERIFICATION_RESEND');
    
        return redirect()->back()->with('success', 'Email resent successfully.');
    }

}