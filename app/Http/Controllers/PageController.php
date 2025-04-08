<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Pagemeta;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\User;
use App\Models\Tutor;
use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session;
class PageController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }
    public function index(Request $request) {
        // Fetch active categories for navigation
        $arr['navigation'] = Category::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        // Fetch active cities
        $arr['cities'] = City::where('status', 1) // Assuming a 'status' column
            ->orderBy('name', 'asc')
            ->get();
        // Fetch the page
        $page = Page::find(1);    
        if (empty($page)) {
            return view('errors.404');
        } else {
            $pagedata = Pagemeta::where("page_id", $page->id)
                ->where("page_type", "page")
                ->get();
            if ($pagedata) {
                foreach ($pagedata as $row) {
                    $page->{$row->meta_key} = $row->meta_value;
                }
            }
        }
        $arr['courses_list'] = $this->getCourses();
        $arr['page'] = $page;
        $arr['levels'] = DB::table('levels')->select('id', 'title')->get();  

        // Pass all data to the frontend view
        return view('front/index')->with($arr);
    }
    public function show($slug)
    { 
        $navigation = Category::where('status', 1)
        ->orderBy('order', 'asc')
        ->get();
        // Fetch the CMS page based on slug and status
        $page = Page::where('page_url', $slug)->where('status', 1)->firstOrFail();

        // Return the page to the view
        return view('front.cms', compact('page','navigation'));
    }
 
    public function display(Request $request,$slug){
		$arr = array();
		
        $arr['navigation'] = Category::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
      	$page= Page::where('page_url',$slug)->where('status','1')->first();

       if(empty($page)){
           return view('errors.404');
		}else{
            $pagedata = Pagemeta::where("page_id",$page->id)->where("page_type","page")->get();
			if($pagedata){
				foreach($pagedata as $row){
					$page->{$row->meta_key} = $row->meta_value;
				}
			}
		}
		$page_templates = $page->template; 
   
	
        $arr['cities'] = City::where('status', 1)->orderBy('name', 'asc')->get();
        $arr['courses'] = Course::where('status', 1)->orderBy('title', 'asc')->get();

        $arr['tutors'] = User::where('role_id', 2)->get();
      
        
        $navigation = Category::all(); // Replace with your actual navigation fetching logic
		$arr['page'] = $page;
        return view('front.'.strtolower($page_templates))->with($arr);
	}
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Store the contact data in the database
        ContactUs::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
    public function filterByCourse($course_id)
    {

        $tutor_list = DB::table('tutor_specializations')->where('course_id', $course_id)->get()->pluck('tutor_id');
        
        $tutors = DB::table('users')
           //->join('tutor_specializations', 'users.id', '=', 'tutor_specializations.tutor_id')
            //->where('tutor_specializations.course_id', $course_id)
            ->where('users.role_id', 2)
            ->whereIn('users.id', $tutor_list)
            ->select('users.*')
            ->get();
           
           
        $courses = Course::all(); // Fetch all courses for the filter
        $courses_list = $this->getCourses();
        $page = Page::find(1); // Fetch the page
    
        return view('front.tutor', [
            'tutors' => $tutors,
            'courses' => $courses,
            'courses_list' => $courses_list,
            'page' => $page,
        ]);
    }
 
    public function tutorFilter(Request $request,$course_id = null)
    {
        if ($request->has('course_id') && $request->course_id != null) {
            $course_id = $request->course_id;  
        }
        $arr['course_id'] = $course_id;
        $query = User::where('role_id', 2)->with('tutor');
        $tutorQuery = Tutor::query(); 
		
		if ($request->has('teach_type') && !empty($request->teach_type)) {
			$subject_tutors = \App\Models\SubjectTutor::query();
			if(!empty($request->subject_id)){
				$subject_tutors->where('subject_id',$request->subject_id);
			}
			
			if(!empty($request->level_id)){
				$subject_tutors->where('level_id',$request->level_id);
			}
			
			$tutor_user_ids = $subject_tutors->get()->pluck('user_id');	
										
		}
        
        $user_ids = [];
        $hasTutorFilter = false;
        // Tutors only
        if(!empty($course_id)){         
            $tutorQuery->whereRaw("FIND_IN_SET(?, tutor_specializations)", [$course_id]);            
            $hasTutorFilter = true;
        }
        // Apply price range filter
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $tutorQuery->whereBetween('rate', [$request->min_price, $request->max_price]);
            $hasTutorFilter = true;
        }
        // Apply rating filter
        if ($request->filled('min_rating') && $request->filled('max_rating')) {
            $tutorQuery->whereBetween('rating', [$request->min_rating, $request->max_rating]);
            $hasTutorFilter = true;
        }
        // Apply gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->has('postcode') && $request->postcode != null) {
            $query->where('postcode', $request->postcode);
        }
        if($hasTutorFilter){
            $user_ids = $tutorQuery->get()->pluck('id');
        }
        $specialization = User::where('role_id', 2)->with('tutor')->get();
        $specialization_courses  = array();
        if(!empty($specialization)){
            foreach($specialization as $row){
                if(!empty($row->tutor->tutor_specializations)){
                    $specialization_courses[]  = explode(",",$row->tutor->tutor_specializations);
                }
            }
            $specialization_courses = array_merge(...$specialization_courses);
        }
        
        if(!empty($user_ids)){
            $query->whereIn('id', $user_ids);    
        }
        
        $arr['tutors']= $query->with('tutor')->paginate(10);
        // echo $query->toSql();die;
        // Fetch the page
        $page = Page::find(1);    
        if (empty($page)) {
            return view('errors.404');
        } else {
            $pagedata = Pagemeta::where("page_id", $page->id)
                ->where("page_type", "page")
                ->get();
            if ($pagedata) {
                foreach ($pagedata as $row) {
                    $page->{$row->meta_key} = $row->meta_value;
                }
            }
        }
        $specialization_courses = array_unique($specialization_courses);
        
        $records = DB::table('courses')
        ->whereIn('id', $specialization_courses)
        ->get();
        $arr['records'] = $records;
        $arr['page'] = $page;
        // Pass all data to the frontend view
        $arr['navigation'] = Category::where('status', 1)
        ->orderBy('order', 'asc')
        ->get();
        $arr['courses_list'] = $this->getCourses();
        
        $arr['courses'] = Course::where('status', 1)->orderBy('title', 'asc')->get();

        $arr['course_level'] = DB::table('levels')
        ->join('course_levels', 'levels.id', '=', 'course_levels.level_id')
        ->select('levels.id', 'levels.title', 'course_levels.course_id')
        ->get();

        //dd($levels);

        $arr['levels'] = DB::table('levels')->select('id', 'title')->get();  
        return view('front.tutor')->with($arr);
    }
    public function student(Request $request)
    {
        return view('front.customer');

    }
}
