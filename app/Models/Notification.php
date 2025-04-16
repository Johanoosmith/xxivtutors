<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'user_id',
        'display_postcode',
        'display_qualification',
        'new_enquiry_email',
        'email_on_profile_view',
        'feedback_email',
        'payment_email',
        'lesson_reminder_email',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'user_id');
    }
}
