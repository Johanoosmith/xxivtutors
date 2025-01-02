<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            '' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

       // Handle Header Logo Upload
    if ($request->hasFile('')) {
        $headerLogo = $request->file('');
        $headerLogoName = '_' . time() . '.' . $headerLogo->getClientOriginalExtension();
        $headerLogoPath = public_path('uploads/logos');

        // Create the directory if it doesn't exist
        if (!file_exists($headerLogoPath)) {
            mkdir($headerLogoPath, 0755, true);
        }

        $headerLogo->move($headerLogoPath, $headerLogoName);
        $headerLogoUrl = 'uploads/logos/' . $headerLogoName;
        config(['settings.' => $headerLogoUrl]);
    }

    // Handle Favicon Upload
    if ($request->hasFile('favicon')) {
        $favicon = $request->file('favicon');
        $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
        $faviconPath = public_path('uploads/logos');

        // Create the directory if it doesn't exist
        if (!file_exists($faviconPath)) {
            mkdir($faviconPath, 0755, true);
        }

        $favicon->move($faviconPath, $faviconName);
        $faviconUrl = 'uploads/logos/' . $faviconName;
        config(['settings.favicon' => $faviconUrl]);
    }
        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
