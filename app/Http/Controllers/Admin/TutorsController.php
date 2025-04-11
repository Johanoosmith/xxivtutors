<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you are managing the default User model
use App\Models\Course;
use App\Models\Tutor;
use App\Models\Pagemeta;
use Illuminate\Support\Facades\Storage;

class TutorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Ensure that only admins can access these routes
    }

    /**
     * Display a listing of the users.
     */

     public function index(Request $request)
     {
        $input              = $request->all();
        $tutor              =  Tutor::query();
        $search             =   (object) null;
        $arr['search']      =   $search;
        $showrecord         =   trans('admin.ADMIN_PAGE_LIMIT_NO');
        $search_text        =   '';

        $getRecords = User::with('tutor.specialization')
        ->where('role_id', 2);
        
        if (!empty($input['fullname'])) {
            $search_text    =  $input['fullname'];
            $search_parts = explode(' ', $search_text);
            $getRecords->where(function ($query) use ($search_parts, $search_text) {
                if (count($search_parts) >= 2) {
                    $query->where('firstname', 'like', '%' . $search_parts[0] . '%')
                          ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                } else {
                    // Fallback to checking any field
                    $query->where('firstname', 'like', '%' . $search_text . '%')
                          ->orWhere('lastname', 'like', '%' . $search_text . '%')
                          ->orWhere('email', 'like', '%' . $search_text . '%');
                }
            });
            $search->search_text  =   $search_text;
        }
        if (isset($input['status']) && $input['status'] != '') {
            $status          =   $input['status'];
            $getRecords      =   $getRecords->where('status',$status);
            $search->status  =   $status;
        }
        if (isset($input['showrecord']) && $input['showrecord'] != '') {
            $showrecord = $input['showrecord'];
            $search->showrecord = $showrecord;
            Session::put('showrecord', $showrecord);
        }
        $filters = $request->all();
        unset($filters['_token']);
        $arr['filters'] = $filters;
        $tutors = $getRecords->orderBy('id','desc')->paginate($showrecord);          
         return view('admin.tutors.index', compact('tutors', 'filters', 'search', 'search_text'))->with($arr)->with('i', ($request->input('page', 1) - 1) * $showrecord);
     }
     /** Show the form for creating a new user.
     */
    public function create()
    {
        $courses = Course::all(); // Retrieve all courses
        return view('admin.tutors.create', compact('courses'));

        // Change view name to "student.create"
        //return view('admin.tutors.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:30',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            // 'qualification_1' => 'required|string',
            // 'qualification_2' => 'required|string',
            // 'qualification_3' => 'required|string',
            // 'qualification_4' => 'required|string',
            'experience' => 'required|string',
            // 'rate' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|string|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'specialization' => 'array',
            'postcode' => 'nullable|string|max:10',
            'gender' => 'nullable|string|in:male,female,other',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);
    
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('tutors', 'public');
        }
    
        $user = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'role_id' => 2,
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'status' => $validatedData['status'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : null,
            'profile_image' => $imagePath,
            'postcode' => $validatedData['postcode'],
            'gender' => $validatedData['gender'],
        ]);
    
        $tutor = Tutor::create([
            'short_description' => $validatedData['short_description'],
            'full_description' => $validatedData['full_description'],
            // 'qualification_1' => $validatedData['qualification_1'],
            // 'qualification_2' => $validatedData['qualification_2'],
            // 'qualification_3' => $validatedData['qualification_3'],
            // 'qualification_4' => $validatedData['qualification_4'],
            'experience' => $validatedData['experience'],
            // 'rate' => $validatedData['rate'],
            'rating' => $validatedData['rating'],
            'user_id' => $user->id,
        ]);
        // if ($request->has('specialization')) {
        //     $tutor->specialization()->sync($validatedData['specialization']);
        // }
    
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor registered successfully!');
    }
    
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $tutor = User::where('id', $id)->where('role_id', 2)->with('specialization')->firstOrFail();
        // Change view name to "student.show"
        return view('admin.student.show', compact('user'));
    }
 
    /**
     * Show the form for editing the specified user.
     */
     public function edit($id)
     {
         $tutor = User::with('specialization','tutor')->findOrFail($id);
         //dd($tutor->toArray());
         $courses = Course::all(); // Retrieve all courses

        //  if ($tutor->tutor_specializations) {
        //     $tutor->tutor_specializations  = explode(',',$tutor->tutor_specializations);
        //  }

         if($tutor){			
			$pagedata = Pagemeta::where(["page_id" => $tutor->id,'page_type'=>'page'])->get();
			if($pagedata){
				foreach($pagedata as $row){
					$tutor->{$row->meta_key} = $row->meta_value;
				}
			}
		}


         return view('admin.tutors.edit', compact('tutor', 'courses'));
 
         //$tutor = tutor::findOrFail($id);
         // Change view name to "student.edit"
         //return view('admin.tutors.edit', compact('tutor'));
         // $courses = Course::all();
         // return view('admin.tutors.edit', compact('tutor', 'courses'));
     }

    /**
     * Update the specified user in storage.
     */

     public function update(Request $request, $id)
     {
         $user = User::findOrFail($id);
         $tutor = Tutor::where('user_id', $id)->firstOrFail();
         $validatedData = $request->validate([
             'firstname' => 'required|string|max:255',
             'lastname' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . $id,
             'mobile' => 'required|string|max:15',
             'status' => 'required|int',
             'postcode' => 'nullable|string|max:10',
             'gender' => 'nullable|string|in:male,female,other',
             'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
     
            //  'tutor.short_description' => 'required|string',
            //  'tutor.full_description' => 'required|string',
            //  'tutor.qualification_1' => 'required|string',
            //  'tutor.qualification_2' => 'required|string',
            //  'tutor.qualification_3' => 'required|string',
            //  'tutor.qualification_4' => 'required|string',
             'tutor.experience' => 'required|string',
            //  'tutor.rate' => 'required|string',
             'tutor.rating' => 'nullable|numeric|min:0|max:5',
         ]);
     
         if ($request->hasFile('profile_image')) {
             $newImagePath = $request->file('profile_image')->store('tutors', 'public');
             if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                 Storage::disk('public')->delete($user->profile_image);
             }
             $user->profile_image = $newImagePath;
         }
     
         $user->update([
             'firstname' => $validatedData['firstname'],
             'lastname' => $validatedData['lastname'],
             'email' => $validatedData['email'],
             'mobile' => $validatedData['mobile'],
             'status' => $validatedData['status'],
             'postcode' => $validatedData['postcode'],
             'gender' => $validatedData['gender'],
             'address' => $request->address,
         ]);
     
         $tutorData = $request->input('tutor');
         $tutorData['tutor_specializations'] = $request->has('tutor_specializations') 
             ? implode(",", $request->tutor_specializations) 
             : '';
     
         $tutor->update($tutorData);
     
         if ($request->has('specialization')) {
             $tutor->specialization()->sync($request->specialization);
         }
     
         return redirect()->route('admin.tutors.index')->with('success', 'Tutor updated successfully!');
     }
     
     
    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        // Find the tutor by ID
        
        $tutor = Tutor::where('user_id',$id)->first();
        $user = User::findOrFail($id);
        // Delete the tutor
        $user->delete();
        $tutor->delete();
    
        // Redirect with success message
        return redirect()->route('admin.tutors.index')->with('alert-success', 'Tutor deleted successfully.');
    }
    function update_meta($customdata, $id){		
		if(count($customdata) > 0 ){
			foreach($customdata as $key => $val){				
				if($key == 'home_first_section_img1'){
					if (!empty($val)) {
						$imageName = rand(10, 100) . time() . '.' . $val->extension();
						$val->move(public_path() .config('constants.DS').config('constants.PAGES_URL'), $imageName);
						$path 	= config('constants.DS').config('constants.PAGES_URL').$imageName;
						$val 	= $path;
						Pagemeta::updateOrCreate(
							['page_id' => $id,'page_type' => 'page', 'meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => $val]
						);
					}
				} else {					
					if (!empty($val)) {

						Pagemeta::updateOrCreate(
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => $val]
						);
					}else{
						Pagemeta::updateOrCreate(
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => '']
						);
					}
				}				
			}			
		}
	}
}
