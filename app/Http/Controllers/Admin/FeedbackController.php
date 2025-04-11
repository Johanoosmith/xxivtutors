<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Verification;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with(['student', 'tutor']); 

        if ($request->filled('student')) {
            $search = $request->input('student');
            $search_parts = explode(' ', $search);

            $query->whereHas('student', function ($q) use ($search, $search_parts) {
                if (count($search_parts) >= 2) {
                    $q->where('firstname', 'like', '%' . $search_parts[0] . '%')
                        ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                } else {
                    $q->where('firstname', 'like', '%' . $search . '%')
                        ->orWhere('lastname', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                }
            });
        }

        if ($request->filled('tutor')) {
            $search = $request->input('tutor');
            $search_parts = explode(' ', $search);

            $query->whereHas('tutor', function ($q) use ($search, $search_parts) {
                if (count($search_parts) >= 2) {
                    $q->where('firstname', 'like', '%' . $search_parts[0] . '%')
                        ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                } else {
                    $q->where('firstname', 'like', '%' . $search . '%')
                        ->orWhere('lastname', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                }
            });
        }

        if ($request->filled('tutor_rating')) {
            $query->where('tutor_rating', $request->input('tutor_rating'));
        }

        if ($request->filled('site_rating')) {
            $query->where('site_rating', $request->input('site_rating'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $perPage = $request->input('per_page', 10);
        $feedbacks = $query->paginate($perPage);

        return view('admin.feedback.index', compact('feedbacks'));
    }



    public function approve(Request $request)
    {
        $feedback = Feedback::find($request->id);
        if ($feedback) {
            $feedback->status = 'approved';
            $feedback->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function reject(Request $request)
    {
        $feedback = Feedback::find($request->id);
        if ($feedback) {
            $feedback->status = 'unapproved';
            $feedback->reject_reason = $request->reject_reason;
            $feedback->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
