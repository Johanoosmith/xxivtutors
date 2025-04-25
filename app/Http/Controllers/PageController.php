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
use App\Models\Subject;
use App\Models\SubjectTutor;
use App\Models\SubjectStudent;

use App\Models\ContactUs;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}
    public function index(Request $request)
    {
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
        return view('front.cms', compact('page', 'navigation'));
    }

    public function display(Request $request, $slug)
    {
        //Testing
        if (isset($_GET['test']) && $_GET['test'] == 'test-mail') {
            sendMail('khelesh.mehra@dotsquares.com', [], 'TUTOR_REGISTRATION');
        }


        $arr = array();

        $arr['navigation'] = Category::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $page = Page::where('page_url', $slug)->where('status', '1')->first();

        if (empty($page)) {
            return view('errors.404');
        } else {
            $pagedata = Pagemeta::where("page_id", $page->id)->where("page_type", "page")->get();
            if ($pagedata) {
                foreach ($pagedata as $row) {
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
        return view('front.' . strtolower($page_templates))->with($arr);
    }


    public function SearchPage()
    {
        $arr = [];
        $arr['navigation'] = Category::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $slug = "search";

        $page = Page::where('page_url', $slug)->where('status', '1')->first();

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

        $page_templates = $page->template;

        // ✅ Update these two lines below as per your request

        $staticCities = static_cities();

        // $arr['cities'] = Tutor::whereNotNull('town')
        //     ->groupBy('town')
        //     ->pluck('town');
        $dynamicCities = Tutor::whereNotNull('town')
            ->groupBy('town')
            ->pluck('town')
            ->toArray();

        $allCities = array_unique(array_merge($staticCities, $dynamicCities));
        sort($allCities); // Optional: sort alphabetically

        $arr['cities'] = $allCities;

        $arr['courses'] = Subject::where('featured', 1)
            ->where('status', 1)
            ->orderBy('title', 'asc')
            ->get();

        $arr['tutors'] = User::where('role_id', 2)->get();
        $arr['page'] = $page;
        return view('front.search')->with($arr);
    }
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'phonenumber' => ['required', 'string', 'regex:/^\d{10,15}$/']
        ]);

        // Store the contact data in the database
        ContactUs::create($validatedData);
        $data = [
            'first_name' => $validatedData['firstname'],
            'last_name' => $validatedData['lastname'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
        ];
        // sendMail(config('constants.SITE.EMAIL'), $data, 'CONTACT_US');
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

    public function tutorFilter(Request $request, $course_id = null)
    {

        $course_id = $request->course_id ?? $course_id;
        $arr['course_id'] = $course_id;

        $query = User::query();

        $input = $request->all();
        $arr['type'] = $input['type'] ?? 'tutor';

        if ($arr['type'] == 'student') {
            $query = $this->getStudentQuery($request, $query);
        } else {
            $query = $this->getTutorQuery($request, $query);
        }

        //\DB::connection()->enableQueryLog();

        $arr['users'] = $query->paginate(10);

        // $queries = \DB::getQueryLog();
        // $finalQuery = finalQuery($queries);
        //dd($finalQuery);
        //dd($arr['users']);

        $page = Page::find(1);
        if (!$page) {
            return view('errors.404');
        }
        $pagedata = Pagemeta::where('page_id', $page->id)
            ->where('page_type', 'page')->get();

        foreach ($pagedata as $meta) {
            $page->{$meta->meta_key} = $meta->meta_value;
        }
        $arr['page'] = $page;

        return view('front.tutor')->with($arr);
    }

    function getStudentQuery($request, $query)
    {

        $query->where('role_id', config('constants.ROLE.STUDENT'))->with('student');

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'distance':
                    $query->join('students', 'users.id', '=', 'students.user_id')
                        ->orderBy('students.distance', 'asc')
                        ->select('users.*');
                    break;
            }
        }

        if ($request->slug != null) {
            $query->whereHas('student.subject_students', function ($q) use ($request) {
                $q->where('slug', $request->slug);
            });
        }

        if ($request->level != null) {
            $query->whereHas('student.subject_students', function ($q) use ($request) {
                $q->where('level_id', $request->level);
            });
        }

        if ($request->postcode != null) {
            $query->where('postcode', $request->postcode);
        }


        return $query;
    }

    function getTutorQuery($request, $query)
    {

        $query->where('role_id', config('constants.ROLE.TUTOR'))->with('tutor');

        $query->with('tutor.tutor_subjects');

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'distance':
                    $query->join('tutors', 'users.id', '=', 'tutors.user_id')
                        ->orderBy('tutors.distance', 'asc')
                        ->select('users.*');
                    break;
            }
        }

        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->whereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%$keyword%"])
                    ->orWhere('firstname', 'like', "%$keyword%")
                    ->orWhere('lastname', 'like', "%$keyword%");
            });
        }

        if (
            $request->slug != null
            || $request->level != 'All Levels'
            || $request->subject_title != null
            || $request->postcode != null
        ) {
            if ($request->slug != null) {
                $query->whereHas('tutor.subject_tutors', function ($q) use ($request) {
                    $q->where('slug', $request->slug);
                });
            }
            if ($request->level != null) {
                $query->whereHas('tutor.subject_tutors', function ($q) use ($request) {
                    $q->where('level_id', $request->level);
                });
            }

            if ($request->postcode != null && $request->subject_id != null || $request->postcode != null && $request->level != 'All Levels') {
                $query->where('postcode', $request->postcode);
            }
        }


        if (
            $request->min_price != null
            || $request->max_price != null
            || $request->distance != null
            ||  $request->min_rating != '0'
        ) {

            // $subjec_tutors = SubjectTutor::where('subject_id', $request->subject_id)
            //     ->where('level_id', $request->level)
            //     ->pluck('user_id');
            // if ($request->min_price != null && $request->max_price != null) {
            //     $q->whereBetween('tutors.tutor_subjects.lesson_rate', [$request->min_price, $request->max_price]);
            // } elseif ($request->min_price != null) {
            //     $q->where('tutors.tutor_subjects.lesson_rate', '>=', $request->min_price);
            // } elseif ($request->max_price != null) {
            //     $q->where('tutors.tutor_subjects.lesson_rate', '<=', $request->max_price);
            // }

            $query->whereHas('tutor', function ($q) use ($request) {
                if ($request->min_price != null && $request->max_price != null) {
                    $q->whereBetween('tutor.subject_tutors.lesson_rate', [$request->min_price, $request->max_price]);
                } elseif ($request->min_price != null) {
                    $q->where('tutor.subject_tutors.lesson_rate', '>=', $request->min_price);
                } elseif ($request->max_price != null) {
                    $q->where('tutor.subject_tutors.lesson_rate', '<=', $request->max_price);
                }

                if ($request->distance != null) {
                    $q->whereBetween('tutors.distance', [0, $request->distance]);
                }
                if ($request->min_rating != '0' && $request->min_rating != null) {
                    $q->where('tutors.rating', $request->min_rating);
                }
            });
        }

        if ($request->gender != null) {
            $query->where('gender', $request->gender);
        }


        if ($request->postcode != null) {
            $query->where('postcode', $request->postcode);
        }

        return $query;
    }




    public function student(Request $request)
    {
        return view('front.customer');
    }
}
