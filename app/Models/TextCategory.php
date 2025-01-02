<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class TextCategory extends Model
{
	use Sortable;
   
    protected $sortable = ['id','en_name','ru_name','updated_at'];

    protected $table = 'text_categories';

    protected $fillable = [
        'en_name','ru_name','status'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];    
}
