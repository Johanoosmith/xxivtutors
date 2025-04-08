<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $fillable = [
        'title',
        'level',
        'level_type',
        'cities',
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'cities', 'id');
    }
	
	public function course_levels()
    {
        return $this->hasMany(CourseLevel::class);
    }
	
	public static function saveCourseLevel($course_id, $levels){
		$courseLevelObj = new \App\Models\CourseLevel();
		$courseLevelObj->where('course_id', $course_id)->delete();
		
		foreach($levels as $key => $level_id){
			$data[] = [
						'course_id' => $course_id,
						'level_id'  => $level_id,
					];
		}
		
		$courseLevelObj->insert($data);
	}
	
	public static function getCouseLevelList($course_id){
		$courseLevelObj = new \App\Models\CourseLevel();
		return $courseLevelObj->where('course_id', $course_id)->get()->pluck('level_id');
	}
	
	public static function getCouseList(){
		return self::where('status',1)->orderBy('title','ASC')->get()->pluck('title','id');
	}
}
