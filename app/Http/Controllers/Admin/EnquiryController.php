<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\User;

class EnquiryController extends Controller
{
   
    public function index(Request $request)
{
    $query = Enquiry::with(['sender', 'receiver','subject_tutor', 'action_by_user']);

    if ($request->filled('name')) {
        $query->whereHas('sender', function ($q) use ($request) {
            $q->where('firstname', 'like', '%' . $request->name . '%')
              ->orWhere('lastname', 'like', '%' . $request->name . '%')
              ->orWhere('username', 'like', '%' . $request->name . '%')
              ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->name . "%"]);
        })->orWhereHas('receiver', function ($q) use ($request) {
            $q->where('firstname', 'like', '%' . $request->name . '%')
              ->orWhere('lastname', 'like', '%' . $request->name . '%')
              ->orWhere('username', 'like', '%' . $request->name . '%')
              ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->name . "%"]);
        });
    }

    $perPage = $request->get('per_page', 10);
    $enquiries = $query->orderBy('created_at', 'desc')->paginate($perPage);

    return view('admin.enquiries.index', [
        'enquiries' => $enquiries,
        'search' => $request->name
    ]);
}

}
