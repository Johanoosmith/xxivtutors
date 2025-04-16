<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorNotificationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can customize authorization if needed
    }

    public function rules()
    {
        return [
            'list_in_directory'       => 'required|in:0,1',
            'profile_status'          => 'required|in:0,1',
            'display_postcode'        => 'required|in:0,1',
            'display_qualification'   => 'required|in:0,1',
            'new_enquiry_email'       => 'required|in:0,1',
            'email_on_profile_view'   => 'required|in:0,1',
            'feedback_email'          => 'required|in:0,1',
            'payment_email'           => 'required|in:0,1',
            'lesson_reminder_email'   => 'required|in:0,1',
        ];
    }
}
