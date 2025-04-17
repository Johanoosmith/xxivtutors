<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ManageContractController extends Controller
{
    public function index()
    {
        $keys = [
            'contract_declaration_1',
            'contract_declaration_2',
            'contract_declaration_3',
            'contract_declaration_4',
            'contract_declaration_5'
        ];
        $settings = Setting::whereIn('key', $keys)->pluck('value', 'key');
        return view('admin.settings.contract', compact('settings'));
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    //     $keys = [
    //         'contract_declaration_1',
    //         'contract_declaration_2',
    //         'contract_declaration_3',
    //         'contract_declaration_4',
    //         'contract_declaration_5'
    //     ];
    
    //     // Validation: each must be required
    //     $rules = [];
    //     foreach ($keys as $key) {
    //         $rules[$key] = 'required';
    //     }
    //     $request->validate($rules);
    
    //     // Save/update values
    //     foreach ($keys as $key) {
    //         Setting::updateOrCreate(
    //             ['key' => $key],
    //             ['value' => $request->input($key)]
    //         );
    //     }
    
    //     return redirect()->back()->with('success', 'Contracts updated successfully.');
    // }
    

public function store(Request $request)
{
    $keys = [
        'contract_declaration_1',
        'contract_declaration_2',
        'contract_declaration_3',
        'contract_declaration_4',
        'contract_declaration_5'
    ];

    $rules = [];
    foreach ($keys as $key) {
        $rules[$key] = [
            'required',
            function ($attribute, $value, $fail) {
                // Strip tags and trim
                $plain = trim(strip_tags($value));
                if (empty($plain)) {
                    $fail("The " . str_replace('_', ' ', $attribute) . " field is required.");
                }
            }
        ];
    }

    $request->validate($rules);

    foreach ($keys as $key) {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $request->input($key)]
        );
    }

    return redirect()->back()->with('success', 'Contracts updated successfully.');
}

}
