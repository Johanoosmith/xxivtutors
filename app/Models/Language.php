<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Language extends Model
{
	protected $table = 'languages';
    protected $fillable = [
        'name',
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function tutors()
    {
        return $this->hasMany(Tutor::class, 'language');
    }

}
