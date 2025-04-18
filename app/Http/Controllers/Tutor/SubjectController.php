<?php

namespace App\Http\Controllers\Tutor;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use App\Models\SubjectTutor;
use Illuminate\Http\Request;




class SubjectController extends Controller
{
    public function index(Request $request)
    {
		$perPage = 10; // Adjust as necessary
		$user_id = Auth::user()->id;

		// Create a new query for the Subject model
		$query = SubjectTutor::query();

		
		
		$query->where('user_id',$user_id)
							->with(['subject','level'])
							->orderBy('id','DESC');
							
		$SOObj	= 	clone $query;			
		
		// Paginate the query results
		$subject_tutors = $query->where('type',1)->paginate($perPage);
							
		$subject_tutors_online = $SOObj->where('type',2)->paginate($perPage);
		
		return view('tutor.subjects.index', compact('subject_tutors', 'subject_tutors_online'));
    }

    public function create()
    {
		$courses = Course::getCouseList();
		$subjects = $levels = [];
		$course_level_type = '';
		if(!empty(request()->old('course_id'))){
			$course_id = request()->old('course_id');
			$subjects = Subject::getSubjectByCourse($course_id);
			
			$course_levels  = Course::getCouseLevelList($course_id, 'id');
			if(!empty($course_levels)){
				$levels = \App\Models\Level::getLevelList($course_levels);
			}

			$course = Course::where('id',$course_id)->first();
			if(!empty($course)){
				$course_level_type = $course->level_type;
			}

		}
		
		
		
		return view('tutor.subjects.create', compact('courses','subjects','levels','course_level_type'));
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
				'level'		 => 'array|min:1',

				// level_id is optional
				'level.*.level_id' => 'nullable|integer',
				'level' => ['required', 'array', function ($attribute, $value, $fail) {
					if (!collect($value)->pluck('level_id')->filter()->count()) {
						$fail('At least one level must have a level_id.');
					}
				}],

				// hourly_rate and lesson_rate are required only if level_id is filled
				'level.*.hourly_rate' => 'required_with:level.*.level_id|nullable|numeric|min:5',
				'level.*.lesson_rate' => 'required_with:level.*.level_id|nullable|numeric|min:5',
			],
			[
				// Custom error message for lesson_rate
				'level.*.lesson_rate.required_with' => 'The student rate is required when a level ID is present.',
				'level.*.lesson_rate.numeric' => 'The student rate must be a number.',
				'level.*.lesson_rate.min' => 'The student rate must be at least :min.',
			]
		);
			
			$subject_tutor = $request->all();
			$count = 0;
			$data = [];
			foreach($subject_tutor['level'] as $record){
				if(
					!empty($record['level_id']) 
					&& !empty($record['hourly_rate'])
					&& !empty($record['lesson_rate'])	
				) {
					
					++$count;
					$data[$count] = [
						'user_id'	=> $user_id,
						'subject_id'	=> $subject_tutor['subject_id'],
						'course_id' 	=> $subject_tutor['course_id'],
						'level_id'  	=> $record['level_id'],
						'hourly_rate' 	=> $record['hourly_rate'],
						//'lesson_rate' 	=> $record['lesson_rate'],
						'lesson_rate' 	=> getStudentPrice($record['hourly_rate']),
						'type'			=> 1
					];
					
					$record = Subject::isSubjectTutorRecordExists($data[$count]);
					if(empty($record)){
						SubjectTutor::create($data[$count]);
					}
				}
			}
			
			
			
			if(!empty($subject_tutor['teach_online']) && !empty($data)){
				foreach($data as $online_record){
					$online_record['type'] = 2; //Online
					$record = Subject::isSubjectTutorRecordExists($online_record);
					if(empty($record)){
						SubjectTutor::create($online_record);
					}
				}	
			}
			
			
		} else {
			// **Validation when individual fields exist**
			$request->validate(
				[
				'subject_id' => 'required',
				'course_id'  => 'required',
				'level_id'  => 'required|integer',
				'hourly_rate' => 'required|numeric|min:5',
				'lesson_rate' => 'required|numeric|min:5',
				],
				[
					'lesson_rate.required' => 'The student rate is required.',
					'lesson_rate.numeric' => 'The student rate must be a number.',
					'lesson_rate.min' => 'The student rate must be at least :min.',
				]
			);
			
			$subject_tutor = $request->all();
			$subject_tutor['user_id'] = $user_id;
			$subject_tutor['lesson_rate'] = getStudentPrice($subject_tutor['hourly_rate']);
			
			
			$subject_tutor['type'] = 1; //In-person
			$data[0] = $subject_tutor;
			if(!empty($subject_tutor['teach_online'])){
				$data[1] 		 = $data[0];	
				$data[1]['type'] = 2; //Online
			}
			
			foreach($data as $subject_tutor){
				$record = Subject::isSubjectTutorRecordExists($subject_tutor);
				if(empty($record)){
					SubjectTutor::create($subject_tutor);
				}
			}
		}
		
		return redirect()->route('tutor.subjects.index')->with('success', 'Subject created successfully.');
    }
	
    public function edit(SubjectTutor $subject)
    {
		
        
		$courses = Course::getCouseList();
		$subjects = $levels = [];
		
		$subjects = Subject::getSubjectByCourse($subject->course_id);
		
		$course_levels  = Course::getCouseLevelList($subject->course_id, 'id');
		if(!empty($course_levels)){
			$levels = \App\Models\Level::getLevelList($course_levels);
		}
		
		
        return view('tutor.subjects.edit', compact('subject','subjects','courses','levels'));
    }

    public function update(Request $request, SubjectTutor $subject)
    {
        $request->validate([
			'level_id'  => 'required|integer',
			'hourly_rate' => 'required|numeric|min:5',
		]);
		
		$subject_tutor = SubjectTutor::findOrFail($subject->id);
		
		$subject_tutor->level_id 	= $request->level_id;
		$subject_tutor->tags = $request->tags;
		$subject_tutor->hourly_rate = $request->hourly_rate;
		$subject_tutor->lesson_rate = getStudentPrice($request->hourly_rate);
		
		$subject_tutor->save();
		
        return redirect()->route('tutor.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Request $request)
    {
		if($request->isMethod('post')){
			$user_id = Auth::user()->id;
			$subject_tutor_id = $request->subject_tutor_id;
			SubjectTutor::where('id',$subject_tutor_id)->where('user_id',$user_id)->delete();
		}
        
        return redirect()->route('tutor.subjects.index')->with('success', 'Subject deleted successfully.');
    }
	
	public function getSubjectByCourse($course_id, $selected_id=NULL)
    {
        $subjectObj = new Subject();
		$subjects = $subjectObj->getSubjectByCourse($course_id);
        return view('tutor.subjects.get_subject_by_course',compact('subjects','selected_id'));
    }

	/* You will get level and rate fields */
	public function getFieldsByCourse($course_id, $selected_id=NULL)
    {
		$request = request();
		if($request->ajax()){
			$course	= Course::where('status',1)->where('id',$course_id)->first();
			$course_levels = [];
			$levels = [];
			if(!empty($course)){
				$course_levels  = Course::getCouseLevelList($course_id, 'id');
				if(!empty($course_levels)){
					$levels = \App\Models\Level::getLevelList($course_levels);
				}
			}
		
			return view('tutor.subjects.get_fields_by_course',compact('levels','course','selected_id'));
		}
    }
    
}

