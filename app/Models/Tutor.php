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
        'experience', 'rate', 'status'
    ];
    public function specialization()
{
    return $this->belongsToMany(Course::class, 'tutor_specializations', 'tutor_id', 'course_id');
}
}
