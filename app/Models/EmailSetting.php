<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class EmailSetting extends Model
{
	use Sortable;
   
    protected $table = 'email_settings';

    protected $fillable = [
        'host','username','password','port','encryption','transport','from_email','from_name','to_email'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

}