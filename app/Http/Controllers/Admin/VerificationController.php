<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Verification::with('user');

        if ($request->filled('user')) {
            $search = $request->input('user');
            $search_parts = explode(' ', $search);

            $query->whereHas('user', function ($q) use ($search, $search_parts) {
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

        if ($request->filled('verification_type')) {
            $query->where('verification_type', $request->input('verification_type'));
        }

        $perPage = $request->input('per_page', 10);
        $verifications = $query->paginate($perPage);

        return view('admin.verifications.index', compact('verifications'));
    }

    public function show($id)
    {
        $Verification = Verification::with('user')->where('id', $id)->first();
        return view('admin.verifications.view', compact('Verification'));
    }

    public function approve($id)
    {
        $verification = Verification::findOrFail($id);
        $verification->status = 1;
        $verification->reject_reason = null;
        $verification->save();
    
        return redirect()->back()->with('success', 'Verification approved.');
    }
    
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject_reason' => 'required|string|max:255',
        ]);
    
        $verification = Verification::findOrFail($id);
        $verification->status = 3;
        $verification->reject_reason = $request->reject_reason;
        $verification->save();
    
        return redirect()->back()->with('error', 'Verification rejected.');
    }
    


}
