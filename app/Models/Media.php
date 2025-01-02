<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
	use  SoftDeletes;
   
  
    protected $table = 'medias';

    protected $fillable = [
        'user_id','type','title','section','image','image_path','image_type','image_size','status'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id']; 
	
    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }   
}