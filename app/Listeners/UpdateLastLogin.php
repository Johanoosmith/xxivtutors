<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateLastLogin
{
      /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Update the user's last login timestamp
                // Update the user's last_login timestamp
                $event->user->update([
                    'last_login' => now(),
                ]);
    }
    
}
