<?php
namespace App\Http\Controllers\Tutor;


use App\Models\Tutor;
use App\Models\Notification;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class TutorNotificationController extends Controller
{
public function edit()
{
    $id = Auth::user()->id;

    $tutor = Tutor::with('notification')->findOrFail($id);
    return view('tutor.tutor_privacy', compact('tutor'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'list_profile_directory' => 'required|in:Yes,No',
        'profile_status' => 'nullable|string',
        // Validation rules for notifications dropdowns
    ]);

    $tutor = Tutor::findOrFail($id);
    $tutor->update([
        'list_profile_directory' => $request->list_profile_directory,
        'profile_status' => $request->profile_status,
    ]);

    $notificationData = $request->only([
        'display_postcode',
        'display_qualification',
        'new_enquiry_email',
        'email_on_profile_view',
        'feedback_email',
        'payment_email',
        'lesson_reminder_email',
    ]);

    Notification::updateOrCreate(
        ['user_id' => $tutor->id], // Assuming tutor_id = user_id in notifications
        $notificationData
    );

    return redirect()->back()->with('success', 'Updated successfully!');
}
}
