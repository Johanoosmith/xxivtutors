<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
	use  SoftDeletes;
   
  
    protected $table = 'email_templates';

    protected $fillable = [
        'language_id','subject','message','action','constants'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];    
    
}