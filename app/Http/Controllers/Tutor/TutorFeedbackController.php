<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a Customer model
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use App\Models\Tutor;
use App\Models\Question;
use App\Models\Booking;

class TutorFeedbackController extends Controller
{
    // Show Feedback Form
    public function feedbackList()
    {
        $user = Auth::user();
        $submittedFeedback = Feedback::where('tutor_id', $user->id)
        ->with('student') // This will fetch tutor details from the User table
        ->get();

        return view('tutor.tutor_feedback', compact('submittedFeedback'));
    }
}