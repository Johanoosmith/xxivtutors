<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'subject_tutor_id', 'content', 'status', 'is_read', 'report_reason','action_by'];

    // Define the relationship with the User model
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
	public function subject_tutor()
    {
        return $this->belongsTo(SubjectTutor::class, 'subject_tutor_id');
    }

    public function booking_enquiry()
    {
        return $this->hasMany(BookingEnquiry::class);
    }

    public function enquiry_comments()
    {
        return $this->hasMany(EnquiryComment::class);
    }

}
