<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model
{
    use HasFactory;

    // Table name (if not following Laravel's naming convention)
    protected $table = 'user_qualifications';

    // Allow mass assignment for these attributes
    protected $fillable = [
        'user_id',
        'qtype',
        'qualification_id',
        'institute_name',
        'subject',
        'grade',
        'qyear',
        'qdocument',
        'status',
    ];
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }
}
