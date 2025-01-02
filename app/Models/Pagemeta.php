<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagemeta extends Model
{
	use Sortable, SoftDeletes;
   
    protected $sortable     =   ['id','page_id','created_at'];
    protected $table 	    =   'page_meta';
    protected $fillable     =   ['page_type','meta_key','meta_value','page_id' ,'status'];
	
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];    

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
