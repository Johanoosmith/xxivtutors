<?php
namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['tutor', 'student', 'booking']);
        // dd($query);

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('student', function ($subQ) use ($request) {
                    $subQ->where('firstname', 'like', '%' . $request->name . '%')
                        ->orWhere('lastname', 'like', '%' . $request->name . '%')
                        ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->name . "%"]);
                })->orWhereHas('tutor', function ($subQ) use ($request) {
                    $subQ->where('firstname', 'like', '%' . $request->name . '%')
                        ->orWhere('lastname', 'like', '%' . $request->name . '%')
                        ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->name . "%"]);
                });
            });
        }
        

        if ($request->filled('start_date')) {
            $query->whereHas('booking', function ($q) use ($request) {
                $q->whereDate('start_date', '>=', $request->start_date);
            });
        }

        if ($request->filled('end_date')) {
            $query->whereHas('booking', function ($q) use ($request) {
                $q->whereDate('start_date', '<=', $request->end_date);
            });
        }

        $perPage = $request->get('per_page', 10);
        $payments = $query->orderBy('created_at', 'desc')->paginate($perPage);
        // dd($payments);
        return view('admin.payments.index', compact('payments'));
    }
}
