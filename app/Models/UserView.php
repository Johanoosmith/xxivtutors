<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class UserView extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'user_views';

    // Define the fillable attributes
    protected $fillable = [
        'user_id',
        'viewer_id',
        'view',
        'date',
    ];
    public function setViewCount($user_id)
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return; // Ensure the user is authenticated
        }
        $authLoginId = $authUser->id;
        
        // Find the user being viewed by their username
        $user = \App\Models\User::where('id', $user_id)->first();
        if (!$user) {
            return; // If user doesn't exist, exit the function
        }

        // Prepare data for the user view entry
        $data = [
            'user_id' => $user->id,
            'viewer_id' => $authLoginId,
            'view' => 1,
            'date' => now(), 
        ];
        // Check if a record already exists for the same user and viewer
        $existingView = UserView::where('user_id', $user->id)
            ->where('viewer_id', $authLoginId)
            ->first();
        if ($existingView) {
            // Update the existing record's view count or date if necessary
            $existingView->update($data);
        } else {
            // Create a new record for the view
            UserView::create($data);
        }
    }
}
