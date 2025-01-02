<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you are managing the default User model
use App\Models\Course;
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
        $getRecords         =   new User();
        $search             =   (object) null;
        $arr['search']      =   $search;
        $showrecord         =   trans('admin.ADMIN_PAGE_LIMIT_NO');
        $search_text        =   '';
        $getRecords         =   $getRecords->where('role_id',  "2");
        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text    =  $input['search_text'];
            $getRecords     =  $getRecords->where(function ($query) use ($search_text) {
                $query->where('firstname', 'LIKE', "%$search_text%")->orWhere('lastname', 'LIKE', "%$search_text%")->orWhere('email', 'LIKE', "%$search_text%");
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
        // Validate the incoming request
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors,email',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:30',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'qualification_1' => 'required|string',
            'qualification_2' => 'required|string',
            'qualification_3' => 'required|string',
            'qualification_4' => 'required|string',
            'experience' => 'required|string',
            'rate' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|string|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specialization' => 'array', // Ensure specialization is an array
            'postcode' => 'nullable|string|max:10',
            'gender' => 'nullable|string|in:male,female,other',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);
        $imagePath = null;

        if ($request->hasFile('profile_image')) {
            // Store the file in the "tutors" directory inside the "public" disk
            $imagePath = $request->file('profile_image')->store('tutors', 'public');
        }
        

        // Create the tutor without specialization (since it is a many-to-many relation)
        $tutor = User::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'short_description' => $validatedData['short_description'],
            'full_description' => $validatedData['full_description'],
            'qualification_1' => $validatedData['qualification_1'],
            'qualification_2' => $validatedData['qualification_2'],
            'qualification_3' => $validatedData['qualification_3'],
            'qualification_4' => $validatedData['qualification_4'],
            'experience' => $validatedData['experience'],
            'rate' => $validatedData['rate'],
            'status' => $validatedData['status'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : null,
            'profile_image' => $imagePath,
            'postcode' => $validatedData['postcode'],
            'gender' => $validatedData['gender'],
            'rating' => $validatedData['rating'],
        ]);

        
    
        // Sync the specialization s if provided
        if ($request->has('specialization')) {
            $tutor->specialization()->sync($validatedData['specialization']);
        }
    
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
         $tutor = User::with('specialization')->findOrFail($id);
         $courses = Course::all(); // Retrieve all courses

         if ($tutor->tutor_specializations) {
            $tutor->tutor_specializations  = explode(",",$tutor->tutor_specializations);
         }

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
        $data = $request->all();	
        // Validate the form data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors,email,' . $id,
            'mobile' => 'required|string|max:15',
            'short_description' => 'required|string',
            'full_description' => 'required|string',
            'qualification_1' => 'required|string',
            'qualification_2' => 'required|string',
            'qualification_3' => 'required|string',
            'qualification_4' => 'required|string',
            'experience' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rate' => 'required|string',
            'status' => 'required|int',
            'password' => 'nullable|string|min:8',
            'postcode' => 'nullable|string|max:10',
            'gender' => 'nullable|string|in:male,female,other',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        // Find the tutor by ID
        $tutor = User::findOrFail($id);
        // Only update the password if provided
        if (!empty($request->password)) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']); // Remove password if not updating
        }
        // Update the tutor's main information
        $tutor->update($validatedData);
        if(isset($data['pagemeta'])){
			$this->update_meta($data['pagemeta'],$id);
		}
        // Sync selected specialization s
        if ($request->has('tutor_specializations')) {
            $tutor->tutor_specializations  = implode(",",$request->tutor_specializations);
        }else{
            $tutor->tutor_specializations= '';
        }
        if ($request->hasFile('profile_image')) {
            $newImagePath = $request->file('profile_image')->store('tutors', 'public');
            // Delete the old image if it exists
            if ($tutor->profile_image && Storage::disk('public')->exists($tutor->profile_image)) {
                Storage::disk('public')->delete($tutor->profile_image);
            }
            $validatedData['profile_image'] = $newImagePath;
        }

        $tutor->update($validatedData);
        // Redirect to the tutor list page or show success message
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor updated successfully!');
    }
    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        // Find the tutor by ID
        $tutor = User::findOrFail($id);
    
        // Delete the tutor
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
