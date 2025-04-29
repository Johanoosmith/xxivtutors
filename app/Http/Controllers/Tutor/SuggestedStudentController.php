<?php
namespace App\Http\Controllers\Tutor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SubjectTutor;
use Illuminate\Support\Facades\Auth;

class SuggestedStudentController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     if ($user->role_id != 2) {
    //         abort(403, 'Unauthorized action.');
    //     }
    //     $userId = $user->id;
    //     $students = SubjectTutor::where('subject_tutors.user_id', $userId)
    //             ->leftJoin('levels', 'subject_tutors.level_id', '=', 'levels.id')
    //             ->leftJoin('subjects', 'subject_tutors.subject_id', '=', 'subjects.id')
    //             ->leftJoin('subject_students', function ($join) {
    //                 $join->on('subject_tutors.subject_id', '=', 'subject_students.subject_id')
    //                      ->on('subject_tutors.level_id', '=', 'subject_students.level_id');
    //             })
    //             ->leftJoin('students', 'subject_students.user_id', '=', 'students.user_id')
    //             ->leftJoin('county', 'students.county', '=', 'county.id') // Join county table

    //             ->select(
    //                 'subject_tutors.*',
    //                 'levels.title as level_title',
    //                 'subjects.title as subject_title',
    //                 'county.name as county', // Alias as `county` so view doesn't change
    //                 'students.town',
    //                 'students.user_id as student_user_id'
    //             )->distinct()
    //             ->get();
    //             // dd($students);
    //     return view('tutor.suggested_student', compact('students'));
    // }

    public function index()
{
    $user = Auth::user();
    if ($user->role_id != config('constants.ROLE.TUTOR')) {
        abort(403, 'Unauthorized action.');
    }

    $userId = $user->id;

$students = SubjectTutor::where('subject_tutors.user_id', $userId)
    ->leftJoin('levels', 'subject_tutors.level_id', '=', 'levels.id')
    ->leftJoin('subjects', 'subject_tutors.subject_id', '=', 'subjects.id')
    ->leftJoin('subject_students', function ($join) {
        $join->on('subject_tutors.subject_id', '=', 'subject_students.subject_id')
             ->on('subject_tutors.level_id', '=', 'subject_students.level_id');
    })
    ->leftJoin('students', 'subject_students.user_id', '=', 'students.user_id')
    ->leftJoin('county', 'students.county', '=', 'county.id')
    ->select(
        'subject_tutors.subject_id', // Select only subject_id and level_id
        'subject_tutors.level_id', 
        'levels.title as level_title',
        'subjects.title as subject_title',
        'county.name as county',
        'students.town',
        'students.user_id as student_user_id'
    )
    ->whereNotNull('students.user_id') // Only get rows where user_id exists
    ->distinct() // Apply distinct on the entire row
    ->get();


    return view('tutor.suggested_student', compact('students'));
}

}
