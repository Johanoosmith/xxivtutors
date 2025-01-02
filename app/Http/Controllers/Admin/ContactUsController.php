<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::orderBy('created_at', 'desc')->paginate(10);
       
        return view('admin.contact_us.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = ContactUs::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contact-us.index')->with('success', 'Contact form submission deleted successfully!');
    }
}
