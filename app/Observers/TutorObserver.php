<?php
namespace App\Observers;

use App\Models\Tutor;
use App\Models\User;

class TutorObserver
{
        public function updated(Tutor $tutor)
        {
            // Check if booking_status changed
            if ($tutor->isDirty('booking_status')) {
                $user = User::find($tutor->user_id); // assuming 'user_id' exists in 'tutors' table
    
                if ($user && $user->email) {
                    $status = $tutor->booking_status;
                    $slug = $status == 1 ? 'TUTOR_BOOKING_ENABLED' : 'TUTOR_BOOKING_DISABLED';
    
                    $data = [
                        'user_name' => $user->fullname ?? 'User',
                    ];
    
                    sendMail($user->email, $data, $slug);
                }
            }
        }
}
