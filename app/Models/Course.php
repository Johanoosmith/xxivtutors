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
        'cities',
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'cities', 'id');
    }
}
