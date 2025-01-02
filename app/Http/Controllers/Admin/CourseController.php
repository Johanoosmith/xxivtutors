<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\City;
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
    if ($request->has('level') && !empty($request->level)) {
        $query->where('level', $request->level);
    }

    // Paginate the query results
    $courses = $query->paginate($perPage);

    // Pass the current search and level filters back to the view so they persist
    return view('admin.courses.index', compact('courses'))->with([
        'search' => $request->search,
        'level' => $request->level,
    ]);
    }

    public function create()
    {
       
        return view('admin.courses.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'level' => 'required|in:beginner,intermediate,expert',
            'city' => 'required',
            
        ]);

        Course::create($request->all());
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }
    

    public function edit($id)
    {
        $course = Course::find($id);  
        $cities = City::where(['status'=>'1'])->orderBy('name','asc')->get();
        $course->cities    =    explode(",",$course->cities);  
        return view('admin.courses.edit', compact('course','cities'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'level' => 'required|in:beginner,intermediate,expert',            
        ]);

        $data   =  $request->all(); 
        
        if(!empty($data['cities'])){
            $data['cities']    =  implode(",",$data['cities']);
        }else{
            $data['cities']    = null;
        }     

        $course->update($data);
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
    
}

