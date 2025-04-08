<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTutor extends Model
{
    protected $fillable = ['course_id', 'user_id', 'subject_id', 'level_id', 'type', 'hourly_rate', 'lesson_rate','tags'];

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
	
	public static function getTutorSubjectByUser($user_id)
	{
		$subjects = self::where('user_id',$user_id)
						->with(['subject','level'])
						->get()
						->groupBy(function ($item) {
							return $item->course_id . '-' . $item->subject_id . '-' . $item->level_id . '-' . $item->type . '-' . $item->hourly_rate . '-' . $item->lesson_rate;
						});
		
		return $subjects;
	}
	
	public static function getTutorSubjectList($user_id) {
		
		$tutor_subjects = self::getTutorSubjectByUser($user_id);
		$list = [];
		
		if(!empty($tutor_subjects)){
			$list = $tutor_subjects->toArray();	
		}
		
		return $list;
	}
}
