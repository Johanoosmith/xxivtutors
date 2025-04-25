<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // public function index()
    // {
    //     $contacts = ContactUs::orderBy('created_at', 'desc')->paginate(10);
       
    //     return view('admin.contact_us.index', compact('contacts'));
    // }

    public function index(Request $request)
    {
        $query = ContactUs::query();

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->name . '%')
                  ->orWhere('lastname', 'like', '%' . $request->name . '%')
                  ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%" . $request->name . "%"]);
            });
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $perPage = $request->get('per_page', 10);
        $contacts = $query->orderBy('created_at', 'desc')->paginate($perPage)->appends($request->all());

        return view('admin.contact_us.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact_us.index')->with('success', 'Contact form submission deleted successfully!');
    }
}
