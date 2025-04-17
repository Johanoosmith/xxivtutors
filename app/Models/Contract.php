<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['tutor_id','student_id','cd_1','cd_2','cd_3','cd_4','cd_5','cd_6','signature','ip_address','start_date','end_date','signed_date','status'];


    public function tutor(){
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}