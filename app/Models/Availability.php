<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'days', 'time_slot', 'available'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
