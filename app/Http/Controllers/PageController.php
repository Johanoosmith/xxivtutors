<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Pagemeta;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\User;
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
        $arr['page'] = $page;
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
      	$page= Page::Where('page_url',$slug)->Where('status','1')->first();
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
   
		if(isset($_REQUEST['key'])){
			phpinfo();
		}
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
            'phonenumber' => 'required|string|max:15',
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
        $page = Page::find(1); // Fetch the page
    
        return view('front.tutor', [
            'tutors' => $tutors,
            'courses' => $courses,
            'page' => $page,
        ]);
    }
    public function tutorFilter(Request $request)
    {
        $query = User::where('role_id', 2); // Tutors only

        // Apply price range filter
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('rate', [$request->min_price, $request->max_price]);
        }
        // Apply rating filter
        if ($request->filled('min_rating') && $request->filled('max_rating')) {
            $query->whereBetween('rating', [$request->min_rating, $request->max_rating]);
        }
        // Apply gender filter
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->has('postcode') && $request->postcode != null) {
            $query->where('postcode', $request->postcode);
        }
        if ($request->has('course_id') && $request->course_id != null) {
            $query->where('course_id', $request->course_id);
        }
        $specialization = User::where('role_id', 2)->get();
        $specialization_courses  = array();
        if(!empty($specialization)){
            foreach($specialization as $row){
                if(!empty($row->tutor_specializations)){
                    $specialization_courses[]  = explode(",",$row->tutor_specializations);
                }
            }
            $specialization_courses = array_merge(...$specialization_courses);
        }
       
        $arr['tutors']= $query->paginate(10);
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
  
        $records = DB::table('courses')
        ->whereIn('id', $specialization_courses)
        ->get();
        $arr['records'] = $records;
        //dd($records);
        $arr['page'] = $page;
        // Pass all data to the frontend view
        $arr['navigation'] = Category::where('status', 1)
        ->orderBy('order', 'asc')
        ->get();
        return view('front.tutor')->with($arr);
    }
}
