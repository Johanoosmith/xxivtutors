<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function updated(User $user)
    {
        // Check if 'status' field was changed
        if ($user->isDirty('status')) {
            $newStatus = $user->status;

            $slug = $newStatus == 1 ? 'USER_ACTIVATED' : 'USER_DEACTIVATED';
            $data = [
                'user_name' => $user->fullname ?? 'User',
            ];

            if ($user->email) {
                sendMail($user->email, $data, $slug);
            }
        }
    }
}
