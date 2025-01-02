<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use  SoftDeletes;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', 'password', 'firstname', 'lastname', 'mobile', 
        'address', 'profile_image', 'short_description', 'full_description',
        'qualification_1', 'qualification_2', 'qualification_3', 'qualification_4',
        'experience', 'rate', 'status','postcode', 'gender', 'rating','tutor_specializations'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
 
    public function media(){
        return $this->hasMany(Media::class,'user_id','id');
    }  
    
    public function specialization()
    {
        return $this->belongsToMany(Course::class, 'tutor_specializations', 'tutor_id', 'course_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'tutor_specializations', 'tutor_id', 'course_id');
    }


}
