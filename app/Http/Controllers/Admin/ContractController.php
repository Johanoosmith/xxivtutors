<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $query = Contract::with(['tutor', 'student'])->where('status', 'signed');

        if ($request->filled('name')) {
            $query->whereHas('tutor', function ($q) use ($request) {
                $q->where('firstname', 'like', "%{$request->name}%")
                  ->orWhere('lastname', 'like', "%{$request->name}%");
            })->orWhereHas('student', function ($q) use ($request) {
                $q->where('firstname', 'like', "%{$request->name}%")
                  ->orWhere('lastname', 'like', "%{$request->name}%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $contracts = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.contracts.index', compact('contracts'));
    }

    public function show(Contract $contract)
    {
        $contract->load(['tutor', 'student']);
        return view('admin.contracts.show', compact('contract'));
    }
}
