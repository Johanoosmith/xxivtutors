<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Subject extends Model
{
	use Notifiable;
	
    protected $fillable = ['course_id', 'title', 'cities', 'status'];

	// Boot method to automatically create slug on add & edit
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subject) {
            $subject->slug = static::generateSlug($subject->title);
        });

        static::updating(function ($subject) {
            $subject->slug = static::generateSlug($subject->title);
        });
    }

    // Slug Generation Function
    public static function generateSlug($title)
    {
        return Str::slug(strtolower($title), '-');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

	public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'subject_tutors', 'subject_id', 'user_id');
    }
	
	public static function getSubjectList(){
		$subjects = Subject::where('status',1)->get()->pluck('title','id');
		return $subjects;
	}
	
	public static function getSubjectByCourse($course_id, $type='list'){
		$subject_list = Subject::where('course_id', $course_id)->get()->pluck('title','id');
		return $subject_list;
	}
	
	public static function isSubjectTutorRecordExists($data){
		$query = \App\Models\SubjectTutor::query();
		$data = $query->where('user_id',$data['user_id'])
					->where('course_id',$data['course_id'])
					->where('subject_id',$data['subject_id'])
					->where('type',$data['type'])
					->where('level_id',$data['level_id'])->first();
		
		return $data;
	}
	
	public static function isSubjectStudentRecordExists($data){
		$query = \App\Models\SubjectStudent::query();
		$data = $query->where('user_id',$data['user_id'])
					->where('course_id',$data['course_id'])
					->where('subject_id',$data['subject_id'])
					->where('level_id',$data['level_id'])->first();
		
		return $data;
	}
}
