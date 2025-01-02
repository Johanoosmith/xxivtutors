<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailLog extends Model
{
	use Sortable;
    use  SoftDeletes;
    protected $sortable = [ 'to_email','subject','created_at'];

    protected $table = 'email_logs';

    protected $fillable = [
        'to_email','to_name','from_email','from_name','subject','message','headers','status'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];  
  
}