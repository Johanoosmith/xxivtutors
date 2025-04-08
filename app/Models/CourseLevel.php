<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLevel extends Model
{
    protected $fillable = ['course_id', 'level_id'];
    
	protected $timestamp = false;
	
	public function course()
    {
        return $this->belongsTo(Course::class);
    }
	
	public function level()
    {
        return $this->belongsTo(Level::class);
    }

}
