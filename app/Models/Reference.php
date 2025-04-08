<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'mobile', 
        'profession', 'sent_date', 'status', 'mail_send', 'reject_reason'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
