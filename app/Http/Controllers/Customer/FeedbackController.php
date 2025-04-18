<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a Customer model
use App\Models\Country;
use App\Models\County;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use App\Models\UserView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\Question;
use App\Models\Booking;



class FeedbackController extends Controller
{
    // Show Feedback Form
    public function feedbackList()
    {
        $user = Auth::user();

        $pendingFeedback = Booking::where('student_id', $user->id)
        ->whereNotIn('tutor_id', function ($query) {
            $query->select('tutor_id')->from('feedback');
        })
        ->with('tutor')
        ->select('tutor_id') 
        ->distinct()
        ->get();

//dd($pendingFeedback);
        // Fetch tutors the student has already given feedback for
        $submittedFeedback = Feedback::where('student_id', $user->id)
        ->with('tutor') // This will fetch tutor details from the User table
        ->get();

        return view('customer.student_feedback', compact('pendingFeedback', 'submittedFeedback'));
    }
    public function create($tutor_id)
    {
        $tutor = User::findOrFail($tutor_id);
        // dd($tutor);
        return view('customer.student_feedbackcreate', compact('tutor'));
    }

    // Store Feedback
    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:users,id',
            'site_rating' => 'required|integer|min:1|max:5',
            'tutor_rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500',
        ]);

        Feedback::create([
            'student_id' => Auth::id(),
            'tutor_id' => $request->tutor_id,
            'site_rating' => $request->site_rating,
            'tutor_rating' => $request->tutor_rating,
            'content' => $request->content,
            'status' => 'pending',
        ]);


        return redirect()->route('student.feedback')->with('success', 'Feedback submitted successfully.');
    }
}