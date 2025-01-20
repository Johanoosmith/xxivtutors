<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Category;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        // Start a query on the Subscription model
        $query = Subscription::query();
    
        // Apply Name Filter
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        // Apply Role Filter
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
    
        // Fetch the filtered results with pagination (optional)
        $subscribers = $query->paginate(10);
    
        // Pass the results and the current filters to the view
        return view('admin.subscribers.index', [
            'subscribers' => $subscribers,
            'filters' => $request->only(['name', 'role'])
        ]);
    }
    public function destroy($id)
    {
        $course = Subscription::findOrFail($id);
        $course->delete();
        $navigation = Category::where('status', 1)->orderBy('order', 'asc')->get();
        return redirect()->route('admin.subscriber.index')->with('success', 'Subscribers deleted successfully.')->with('navigation', $navigation);
    }
}
