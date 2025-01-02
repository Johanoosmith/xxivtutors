<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Textsetting extends Model
{
	use Sortable;
    use  SoftDeletes;
    
    protected $sortable = ['id','lang_code','key_text','value','updated_at'];

    protected $table = 'textsettings';

    protected $fillable = [
        'lang_code','key_text','key_value','value'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];  

}