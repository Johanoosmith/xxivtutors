<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\City;
use App\Models\Level;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10; // Adjust as necessary

		// Create a new query for the Course model
		$query = Course::query();

		// Filtering by search (for course title)
		if ($request->has('search') && !empty($request->search)) {
			$query->where('title', 'like', '%' . $request->search . '%');
		}

		// Filtering by level (beginner, intermediate, expert)
		if ($request->has('level_id') && !empty($request->level_id)) {
			$query->whereHas('course_levels', function ($query) use ($request) {
					$query->where('level_id', $request->level_id);
				})->get();
		}

		// Paginate the query results
		$courses = $query->paginate($perPage);
		$levels	 = Level::getLevelList();

		// Pass the current search and level filters back to the view so they persist
		return view('admin.courses.index', compact('courses', 'levels'))->with([
			'search' => $request->search,
			'level_id' => $request->level_id,
		]);
    }

    public function create()
    {
		$levelObj = new Level();
		$levels   = $levelObj->getLevelList();
		
        return view('admin.courses.create', compact('levels'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' 	=> 'required',
            //'level' 	=> 'required|in:beginner,intermediate,expert',
			'level_type'=> 'required|in:single,multiple',
            //'city' 		=> 'required',
            
        ]);
		
		$data = $request->all();

        $course = Course::create($request->all());
		
		Course::saveCourseLevel($course->id, $data['course_levels']);
		
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }
    public function edit($id)
    {
        $course = Course::find($id);  
        $cities = City::where(['status'=>'1'])->orderBy('name','asc')->get();
        $course->cities    =    explode(",",$course->cities);
		
		$levelObj = new Level();
		$levels   = $levelObj->getLevelList();
		
		$course_levels = Course::getCouseLevelList($id)->toArray(); 
		
		
        return view('admin.courses.edit', compact('course','cities','levels','course_levels'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            //'level' => 'required|in:beginner,intermediate,expert',
			'level_type' => 'required|in:single,multiple',
        ]);

        $data   =  $request->all(); 
		
        
        if(!empty($data['cities'])){
            $data['cities']    =  implode(",",$data['cities']);
        }else{
            $data['cities']    = null;
        }

		$course->update($data);
		Course::saveCourseLevel($course->id, $data['course_levels']);
		
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
    
}

