<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a Customer model
use App\Models\Country;
use App\Models\County;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\UserView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Question;


class PostQuestion extends Controller
{    
    public function index()
    {   
        
        $user = Auth::user();
        $user_id = $user->id;
        $questions = Question::with(['user', 'course', 'subject'])->where('user_id', $user_id)->get();
        return view('customer.questions.index', compact('questions'));
        
    }
    public function store(Request $request)
    {   
        $user = Auth::user();
        $user_id = $user->id;
        $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id',
            'reject_reason' => 'nullable|string'
        ]);

        Question::create([
            'user_id' =>  $user_id,
            'course_id' => $request->course_id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'question' => $request->question,
            'reject_reason' => $request->reject_reason
        ]);

        return redirect()->route('student.myquestion')->with('success', 'Question added successfully!');
    }
    public function create()
    {
       $courses = Course::getCouseList();
       $subjects = [];
       if(!empty(request()->old('course_id'))){
            $course_id = request()->old('course_id');
            $subjects = Subject::getSubjectByCourse($course_id);
        }
       return view('customer.questions.add', compact('courses','subjects'));
    }
    public function destroy($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('student.myquestion')->with('success', 'Question deleted successfully!');
    }
}