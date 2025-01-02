<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];

     public function courses()
    {
        return $this->hasMany(Course::class, 'cities', 'id');
    }
}
