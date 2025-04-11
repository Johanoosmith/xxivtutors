<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students'; // Optional if table name matches the plural of the model name

    protected $fillable = [
        'user_id', 'title', 'town', 'county', 'country', 'experience', 'rating', 'dob_year', 'dob_month', 'dob_day', 'language', 'distance', 'bio', 'comments_about_tuition'
        , 'availability'
    ];

    // You can also add mutators for password encryption
    public function specialization()
    {
        return $this->belongsToMany(Course::class, 'tutor_specializations', 'tutor_id', 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
