<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
							'tutor_id', 'student_id', 'subject_tutor_id', 'subject_id',
							'level_id','teaching_location','start_date','start_time',
							'hourly_rate','student_rate','duration','lesson_repeat','day'
						];

    public function tutor()
    {
        return $this->belongsTo(User::class ,'tutor_id', 'id');
    }
	
	public function student()
    {
        return $this->belongsTo(User::class ,'student_id', 'id');
    }
	
	public function subject_tutor()
    {
        return $this->belongsTo(SubjectTutor::class);
    }
	
	public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
	
	public function level()
    {
        return $this->belongsTo(Level::class);
    }
	
	public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function booking_enquiry()
    {
        return $this->hasOne(BookingEnquiry::class);
    }

}
