<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\City;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
		
        $perPage = 10; // Adjust as necessary

		// Create a new query for the Subject model
		$query = Subject::query();

		if (!empty($request->title)) {
			$query->where('title', 'like', '%' . $request->title . '%');
		}

		if (!empty($request->course_id)) {
			$query->where('course_id', $request->course_id);
		}
		
		$courses = Course::where('status',1)->get()->pluck('title','id');

		// Paginate the query results
		$subjects = $query->orderBy('id','DESC')->paginate($perPage);

		return view('admin.subjects.index', compact('subjects','courses'));
    }

    public function create()
    {
		$courses = Course::getCouseList();
       
        return view('admin.subjects.create', compact('courses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:subjects,title'],
            'course_id' => 'required',
        ]);
		
		$data = $request->all();
		$data['status'] = (!empty($data['status'])) ? 1 : 0;
		
        Subject::create($data);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }
    public function edit(Subject $subject)
    {
        $courses = Course::getCouseList();  
		
		$cities = City::where('status',1)->orderBy('name','asc')->get();
        
		if(!empty($subject->cities)){
			$subject->cities  =  explode(",",$subject->cities);
		}
		
		
		
        return view('admin.subjects.edit', compact('subject','courses', 'cities'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'title' => ['required', 'regex:/^[a-zA-Z0-9\s-]+$/', 'unique:subjects,title,'. $subject->id],
            'course_id' => 'required',
        ]);
		
		$data = $request->all();
		$data['status'] = (!empty($data['status'])) ? 1 : 0;
		
		if(!empty($data['cities'])){
            $data['cities']    =  implode(",",$data['cities']);
        }else{
            $data['cities']    = null;
        }

        $subject->update($data);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
    
}

