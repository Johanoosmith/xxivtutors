<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with(['course', 'subject', 'user'])->orderBy('created_at', 'desc');

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->user . '%')
                    ->orWhere('lastname', 'like', '%' . $request->user . '%')
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->user . "%"]);
            });
        }


        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $perPage = $request->get('per_page', 10);
        $questions = $query->paginate($perPage);

        return view('admin.questions.index', compact('questions'));
    }
    public function accept(Request $request)
    {
        $question = Question::findOrFail($request->id);
        $question->status = 'approved';
        $question->reject_reason = null;
        $question->save();

        return response()->json(['success' => true]);
    }
    public function reject(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'reject_reason' => 'required|string',
        ]);

        $question = Question::findOrFail($request->question_id);
        $question->status = 'reject';
        $question->reject_reason = $request->reject_reason;
        $question->save();

        return response()->json(['success' => true]);
    }
}
