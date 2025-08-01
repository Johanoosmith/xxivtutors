<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tutor extends Authenticatable
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'rating',
        'mobile',
        'address',
        'profile_image',
        'short_description',
        'full_description',
        'qualification_1',
        'qualification_2',
        'qualification_3',
        'qualification_4',
        'experience',
        'rate',
        'status',
        'tutor_specializations',
        'user_id',
        'title',
        'town',
        'county',
        'country',
        'list_in_directory',
        'language',
        'profile_status',
        'booking_status'
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

    //01-08-2025
    public function languages()
    {
        $ids = $this->language ? explode(',', $this->language) : [];
        return Language::whereIn('id', $ids)->get();
    }

    //01-08-2025
    public function getLanguageIdsAttribute()
    {
        return $this->language
            ? array_map('intval', explode(',', $this->language))
            : [];
    }

    public function subject_tutors()
    {
        return $this->belongsToMany(Subject::class, 'subject_tutors', 'user_id', 'subject_id');
    }

    public function tutor_subjects()
    {
        return $this->hasMany(SubjectTutor::class, 'user_id');
    }

    public function notification()
    {
        return $this->hasOne(Notification::class, 'user_id');
    }
}
