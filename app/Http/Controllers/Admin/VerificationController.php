<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\Reference;


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
        $Verification = Verification::where('id', $id)->with(['user','country'])->first();
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
    
        return redirect()->back()->with('success', 'Verification rejected.');
    }

    public function references(Request $request){
       $ref_Obj = \App\Models\User::whereHas('references')->withCount('references');
       
        if ($request->filled('user')) {
            $search = $request->input('user');
            $search_parts = explode(' ', $search);

            if (count($search_parts) >= 2) {
                $ref_Obj->where('firstname', 'like', '%' . $search_parts[0] . '%')
                    ->where('lastname', 'like', '%' . $search_parts[1] . '%');
            } else {
                $ref_Obj->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            }
            
        }

        $perPage = $request->input('per_page', 10);

        $references = $ref_Obj->paginate($perPage);
        
        return view('admin.verifications.references', compact('references'));
    }

    public function reference_view($user_id){
        $references = Reference::where('user_id', $user_id)->get();
        return view('admin.verifications.reference_view', compact('references'));
    }

    public function update_reference(Request $request, $id){
        $request->validate([
            'status' => 'required|in:1,2,3',
            'reason' => 'required',
        ]);
    
        $reference = Reference::findOrFail($id);
        $reference->status = $request->status;
        $reference->reason = $request->reason;
        $reference->save();
    
        return redirect()->back()->with('success', 'Reference status updated successfully.');
    }
    


}
