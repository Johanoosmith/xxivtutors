<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    protected $fillable = ['user_id', 'headline_text'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}
