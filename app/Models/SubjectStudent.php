<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectStudent extends Model
{
    protected $fillable = ['course_id', 'user_id', 'subject_id', 'level_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
	
	public function course() {
        return $this->belongsTo(Course::class);
    }
	
	public function subject() {
        return $this->belongsTo(Subject::class);
    }
	
	public function level() {
        return $this->belongsTo(Level::class);
    }


    public static function getStudentSubjectByUser($user_id)
	{
		$subjects = self::where('user_id',$user_id)
						->with(['subject','level'])
						->get();
		
		return $subjects;
	}

}
