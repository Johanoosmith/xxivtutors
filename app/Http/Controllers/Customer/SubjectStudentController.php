<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\SubjectStudent;
use Illuminate\Http\Request;

class SubjectStudentController extends Controller
{
    public function index(Request $request)
    {
		
        $perPage = 10; // Adjust as necessary
		$user_id = Auth::user()->id;

		// Create a new query for the Subject model
		$query = SubjectStudent::query();

		$query->where('user_id',$user_id)
							->with(['subject','level'])
							->orderBy('id','DESC');
		
		// Paginate the query results
		$subject_students = $query->paginate($perPage);
							
		return view('customer.subjects.index', compact('subject_students'));
    }

    public function create()
    {
		$courses = Course::getCouseList();
		$subjects = $levels = [];
		if(!empty(request()->old('course_id'))){
			$course_id = request()->old('course_id');
			$subjects = Subject::getSubjectByCourse($course_id);
			
			$course_levels  = Course::getCouseLevelList($course_id, 'id');
			if(!empty($course_levels)){
				$levels = \App\Models\Level::getLevelList($course_levels);
			}
		}
		
		
		
		return view('customer.subjects.create', compact('courses','subjects','levels'));
    }
    
    public function store(Request $request)
    {
		//dd($request->all());
		$user_id = Auth::user()->id;
        if ($request->has('level')) {
			
			// **Validation when 'level' is an array**
			$request->validate([
				'subject_id' => 'required|integer',
				'course_id'  => 'required|integer',
				'level' => 'nullable|array|min:1',

				// level_id is optional
				'level.*.level_id' => 'nullable|integer',
			]);
			
			$subject_student = $request->all();
			$count = 0;
			foreach($subject_student['level'] as $record){
				if(!empty($record['level_id'])) {
					
					++$count;
					$data[$count] = [
						'user_id'	=> $user_id,
						'subject_id'	=> $subject_student['subject_id'],
						'course_id' 	=> $subject_student['course_id'],
						'level_id'  	=> $record['level_id'],
					];
					
					$record = Subject::isSubjectStudentRecordExists($data[$count]);
					if(empty($record)){
						SubjectStudent::create($data[$count]);
					}
				}
			}
			
		} else {
			// **Validation when individual fields exist**
			$request->validate([
				'subject_id' => 'required',
				'course_id'  => 'required',
				'level_id'  => 'required|integer',
			]);
			
			$subject_student = $request->all();
			$subject_student['user_id'] = $user_id;
			
			
			
			$record = Subject::isSubjectStudentRecordExists($subject_student);
			if(empty($record)){
				SubjectStudent::create($subject_student);
			}
			
		}
		
		return redirect()->route('customer.subjects.index')->with('success', 'Subject created successfully.');
    }
	
    public function edit(SubjectStudent $subject)
    {
		
        
		$courses = Course::getCouseList();
		$subjects = $levels = [];
		
		$subjects = Subject::getSubjectByCourse($subject->course_id);
		
		$course_levels  = Course::getCouseLevelList($subject->course_id, 'id');
		if(!empty($course_levels)){
			$levels = \App\Models\Level::getLevelList($course_levels);
		}
		
		
        return view('customer.subjects.edit', compact('subject','subjects','courses','levels'));
    }

    public function update(Request $request, SubjectStudent $subject)
    {
        $request->validate([
			'level_id'  => 'required|integer',
		]);
		
		$subject_student = SubjectStudent::findOrFail($subject->id);
		
		$subject_student->level_id 	= $request->level_id;
		$subject_student->save();
		
        return redirect()->route('customer.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Request $request)
    {
		if($request->isMethod('post')){
			$user_id = Auth::user()->id;
			$subject_student_id = $request->id;
			SubjectStudent::where('id',$subject_student_id)->where('user_id',$user_id)->delete();
		}
		
        return redirect()->route('customer.subjects.index')->with('success', 'Subject deleted successfully.');
    }
	
	public function getSubjectByCourse($course_id, $selected_id=NULL)
    {
        $subjectObj = new Subject();
		$subjects = $subjectObj->getSubjectByCourse($course_id);
        return view('customer.subjects.get_subject_by_course',compact('subjects','selected_id'));
    }

	/* You will get level and rate fields */
	public function getFieldsByCourse($course_id, $selected_id=NULL)
    {
		$request = request();
		if($request->ajax()){
			$subjects = Subject::getSubjectByCourse($course_id);
			$course	= Course::where('status',1)->where('id',$course_id)->first();
			$course_levels = [];
			$levels = [];
			if(!empty($course)){
				$course_levels  = Course::getCouseLevelList($course_id, 'id');
				if(!empty($course_levels)){
					$levels = \App\Models\Level::getLevelList($course_levels);
				}
			}
		
			return view('customer.subjects.get_fields_by_course',compact('levels','course','subjects','selected_id'));
		}
    }
    
}

