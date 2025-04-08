<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'tutor_id', 'content', 'tutor_rating', 'site_rating', 'purchase_date', 'status'
    ];

    // Relationship: Feedback belongs to a student (User)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relationship: Feedback belongs to a tutor (User)
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

}
