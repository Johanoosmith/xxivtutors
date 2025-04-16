<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SubjectStudent;
use Illuminate\Support\Facades\Auth;

class SuggestedTutorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
        $userId = $user->id;
        $tutors =  SubjectStudent::where('subject_students.user_id', $userId)
            ->leftJoin('subject_tutors', function ($join) {
                $join->on('subject_students.subject_id', '=', 'subject_tutors.subject_id')
                    ->on('subject_students.level_id', '=', 'subject_tutors.level_id');
            })
            ->leftJoin('levels', 'subject_tutors.level_id', '=', 'levels.id')
            ->leftJoin('subjects', 'subject_tutors.subject_id', '=', 'subjects.id')
            ->leftJoin('tutors', 'subject_tutors.user_id', '=', 'tutors.user_id') // tutor's location
            ->leftJoin('county', 'tutors.county', '=', 'county.id') // join counties table

            ->select(
                'subject_tutors.*',
                'levels.title as level_title',
                'subjects.title as subject_title',
                'county.name as county', // alias for compatibility with frontend
                'tutors.town',
            )
            ->get();
        // dd($tutors);
        return view('customer.student_suggestedtutor', compact('tutors'));
    }
}
