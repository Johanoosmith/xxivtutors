<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{

    use Sortable, SoftDeletes;

    protected $table = 'options';
   
    protected $sortable = ['id','created_at'];

    protected $fillable = [ 'type','option_key','option_value'];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
