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

        // Apply filters
    
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('fullname', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
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
            'email' => 'required|email|unique:students,email',
            'contact' => 'required|numeric',
            'password' => 'required|min:6',
            'course' => 'required|string',
            'status' => 'required|string', 
        ]);

         // Save data to the student table
        Student::create([
        'fullname' => $validatedData['fullname'],
        'email' => $validatedData['email'],
        'contact' => $validatedData['contact'],
        'password' => bcrypt($validatedData['password']),
        'course' => $validatedData['course'],
        'status' => $validatedData['status'],
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
        // Validate the form data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:tutors,email,' . $id,
            'contact' => 'required|string|max:15',
            'course' => 'required|string',
            'status' => 'required|string',
            'password' => 'nullable|string|min:8', // Password is optional
        ]);
            // Find the tutor by ID
        $student = Student::findOrFail($id);

        // Only update the password if provided
        if (!empty($request->password)) {
            $validatedData['password'] = bcrypt($request->password);
        } else {
            unset($validatedData['password']); // Remove password if not updating
        }

        // Update the tutor's information
        $student->update($validatedData);

        // Redirect to the tutor list page or show success message
        return redirect()->route('admin.student.index')->with('success', 'User updated successfully!');

    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = Student::findOrFail($id);


        $user->delete();

        return redirect()->route('admin.student.index')->with('success', 'User deleted successfully.');
    }
}
