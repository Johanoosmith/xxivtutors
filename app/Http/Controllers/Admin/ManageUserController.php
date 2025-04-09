<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Student; // Assuming you are managing the default User model

class ManageUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Ensure that only admins can access these routes
    }

    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $search_parts = explode(' ', $searchTerm);
         
            $query->whereHas('user', function ($q) use ($searchTerm, $search_parts) {
                if (count($search_parts) >= 2) {
                    $q->where('firstname', 'like', '%' . $search_parts[0] . '%')
                      ->where('lastname', 'like', '%' . $search_parts[1] . '%');
                } else {
                    $q->where('firstname', 'like', '%' . $searchTerm . '%')
                      ->orWhere('lastname', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
                }
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->whereHas('user', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }
        $query->latest();
        // Handle "Per Page" Selection
        $perPage = $request->input('per_page', 10);  // Default to 10 records per page

        // Get the results, paginated
        $students = $query->paginate($perPage);
        // Pass the filtered tutors and the filter inputs back to the view
        return view('admin.student.index', compact('students'));
    }
    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Change view name to "student.create"
        return view('admin.student.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|numeric',
            'password' => 'required|min:6',
            // 'course' => 'required|string',
            'status' => 'required|string',
        ]);

        $fullName = trim($request->input('fullname'));
        $nameParts = explode(' ', $fullName, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        $user = new User;
        $user->firstname = $firstName;
        $user->lastname = $lastName;
        $user->email = $request->input('email');
        $user->mobile = $request->input('contact');
        $user->password = bcrypt($request->input('password'));
        $user->status = $request->input('status');
        $user->role_id = 1;
        $user->save();

        Student::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.student.index')->with('success', 'Student created successfully');
    }
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        // Change view name to "student.show"
        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
    
        // Change view name to "student.edit"
        return view('admin.student.edit', compact('student'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        // Validate the form data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id, 
            'contact' => 'required|string|max:15',
            'status' => 'required|string',
            'password' => 'nullable|string|min:8', 
        ]);

            $existUser = User::where('id' , $student->user_id)->first();
            if($existUser){
                $user    = $existUser;
            }else{
                $user = new User();
            }
            
            $fullName = trim($request->input('fullname'));
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

          
            $user->firstname = $firstName;
            $user->lastname = $lastName;
            $user->email = $request->input('email');
            $user->mobile = $request->input('contact');
            $user->status = $request->input('status');
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            if($student){
                $student->user_id = $user->id;
                $student->save();
            }

        return redirect()->route('admin.student.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $user = $student->user; 
    
        $student->delete();
    
        if ($user) {
            $user->delete();
        }
        return redirect()->route('admin.student.index')->with('success', 'User deleted successfully.');
    }
}
