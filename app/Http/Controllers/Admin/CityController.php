<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::get();
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

        return redirect()->route('admin.cities.index')->with('alert-success', 'City added successfully!');
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }

    public function update(Request $request,City $cities)
    {
        $request->validate([
            'name' => 'required|string|max:255',          
        ]);
        $city   =  $request->all(); 
        $cities->update($city);
        return redirect()->route('admin.cities.index')->with('alert-success', 'City updated successfully!');
    }
    public function destroy($id)
    {
        $cities = City::findOrFail($id);
        $cities->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully!');
    }

}
