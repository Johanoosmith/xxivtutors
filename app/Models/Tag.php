<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['user_from_id', 'user_to_id', 'date', 'status'];

    // Define the relationship with the User model
    public function user_from()
    {
        return $this->belongsTo(User::class, 'user_from_id');
    }
    public function user_to()
    {
        return $this->belongsTo(User::class, 'user_to_id');
    }

    public static function getUserTagged($user_from_id, $user_to_id)
    {
        return self::where('user_from_id',$user_from_id)
        ->where('user_to_id',$user_to_id)->exists();
    }
	
}
