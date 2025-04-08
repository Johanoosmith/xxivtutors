<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    // Table name (if not following Laravel's naming convention)
    protected $table = 'qualifications';

    // Allow mass assignment for these attributes
    protected $fillable = [
        'qtype',
        'qualification',
        'status',
    ];
    public function userQualifications()
    {
        return $this->hasMany(UserQualification::class);
    }
}
