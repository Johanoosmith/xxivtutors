<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryComment extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'enquiry_id', 'sender_id', 'receiver_id', 'content', 'status'];

    // Relationships
    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
