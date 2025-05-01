<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $query = City::query();
    
        // Apply search if 'search' is present in the request
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Paginate the results, 10 per page
        $perPage = $request->get('per_page', 10);
        $cities = $query->orderBy('id', 'desc')->paginate($perPage);
    
        return view('admin.city.index', compact('cities'));
    }
    public function create()
    {
        $cities = City::all();
        return view('admin.city.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',           
        ]);

        $city  = City::create($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'City added successfully!');
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    { 
        $request->validate([
            'name' => 'required|string|max:255',          
        ]);
    
        $cityData = $request->only(['name']);
        
        $city->update($cityData);
    
        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully!');
    }
    public function destroy($id)
    {
        $cities = City::findOrFail($id);
        $cities->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully!');
    }

}
