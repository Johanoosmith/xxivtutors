<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(Request $request)
    {
		
        $perPage = 10; // Adjust as necessary

		// Create a new query for the Level model
		$query = Level::query();

		if (!empty($request->title)) {
			$query->where('title', 'like', '%' . $request->title . '%');
		}

		if (isset($request->status) && $request->status != '' ) {
			$query->where('status', $request->status);
		}
		
		// Paginate the query results
		$levels = $query->orderBy('id','DESC')->paginate($perPage);

		return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
		return view('admin.levels.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
			[
				'title' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/', 'unique:levels,title'],
			],
			[
				'title.regex' => 'The name may only contain letters, numbers, and spaces.',
			]
		);
		
		
		$data = $request->all();
		$data['status'] = (!empty($data['status'])) ? 1 : 0;
		
        Level::create($data);
        return redirect()->route('admin.levels.index')->with('success', 'Level created successfully.');
    }
    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $request->validate(
			[
				'title' => ['required', 'regex:/^[a-zA-Z0-9\s-]+$/', 'unique:levels,title,'. $level->id],
			],
			[
				'title.regex' => 'The name may only contain letters, numbers, and spaces.',
			]
		);
		
		$data = $request->all();
		$data['status'] = (!empty($data['status'])) ? 1 : 0;

        $level->update($data);
        return redirect()->route('admin.levels.index')->with('success', 'Level updated successfully.');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.levels.index')->with('success', 'Level deleted successfully.');
    }
    
}

