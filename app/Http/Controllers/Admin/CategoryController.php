<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {   

        $perPage = 10; // Adjust as necessary

        $query = Category::query(); // Make sure you're working with a query, not a collection

        // Filtering by name
        if ($request->has('name') && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filtering by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Paginate the query results
        $categories = $query->paginate($perPage);

        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug,',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function show($id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Pass the category data to the view to display it
        return view('admin.categories.show', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);
        $category = Category::findOrFail($id);
        // Handle category image upload if there is an update
        if ($request->hasFile('category_image')) {
            $imageName = time().'.'.$request->category_image->extension();
            $request->category_image->move(public_path('uploads/categories'), $imageName);
            $category->category_image = '/uploads/categories/'.$imageName;
        }
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $category = Category::findOrFail($id);
    //     $category->update($request->all());

    //     return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    // }

    public function destroy($id)
    {
        
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
