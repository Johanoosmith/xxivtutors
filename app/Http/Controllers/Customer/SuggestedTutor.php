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


class SuggestedTutor extends Controller
{    
    public function index()
    {  
        $user = Auth::user();
        $user_id = $user->id;
        $questions = Question::with(['user', 'course', 'subject'])->where('user_id', $user_id)->get();
        return view('customer.student_suggestedtutor');  
    }
}