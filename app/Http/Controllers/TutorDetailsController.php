<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;


class TutorDetailsController extends Controller
{
    public function show($id)
    {
        // Fetch tutor with their specializations
        $navigation = Category::where('status', 1)->get();

        $tutor = User::where('id', $id)
            ->where('role_id', 2) // Ensure it's a tutor
            ->with('specialization')
            ->firstOrFail();

        return view('front.tutors_details', compact('tutor' , 'navigation'));
    }
}
