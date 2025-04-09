<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Booking;
use App\Models\Subscription;
use App\Models\Category;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['tutor', 'student', 'subject' ,'subject_tutor.subject']);
    
        if ($request->filled('user')) {
            $search = trim($request->input('user'));
            $search_parts = explode(' ', $search);
        
            $query->where(function ($query) use ($search, $search_parts) {
                $query->whereHas('tutor', function ($q) use ($search, $search_parts) {
                    $q->where(function ($sub) use ($search, $search_parts) {
                        if (count($search_parts) >= 2) {
                            $sub->where('firstname', 'like', '%' . $search_parts[0] . '%')
                                ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                        } else {
                            $sub->where('firstname', 'like', '%' . $search . '%')
                                ->orWhere('lastname', 'like', '%' . $search . '%')
                                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $search . "%"]);
                        }
                    });
                })
        
                ->orWhereHas('student', function ($q) use ($search, $search_parts) {
                    $q->where(function ($sub) use ($search, $search_parts) {
                        if (count($search_parts) >= 2) {
                            $sub->where('firstname', 'like', '%' . $search_parts[0] . '%')
                                ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                        } else {
                            $sub->where('firstname', 'like', '%' . $search . '%')
                                ->orWhere('lastname', 'like', '%' . $search . '%')
                                ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $search . "%"]);
                        }
                    });
                });
            });
        }
        
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        $perPage = $request->input('per_page', 10);
        $bookings = $query->paginate($perPage);
    
        return view('admin.bookings.index', compact('bookings'));
    }
    



}
