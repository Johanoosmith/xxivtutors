<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tutor extends Authenticatable
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'email', 'password', 'firstname', 'lastname', 'mobile', 
        'address', 'profile_image', 'short_description', 'full_description',
        'qualification_1', 'qualification_2', 'qualification_3', 'qualification_4',
        'experience', 'rate', 'status','tutor_specializations', 'user_id', 'user_id', 'title', 'town', 'county', 'country'
    ];
    public function specialization()
        {
            return $this->belongsToMany(Course::class, 'tutor_specializations', 'tutor_id', 'course_id');
        }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'name');
    }

    public function subject_tutors()
    {
        return $this->belongsToMany(Subject::class, 'subject_tutors', 'user_id', 'subject_id');
    }
}
