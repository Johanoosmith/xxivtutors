<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEnquiry extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'enquiry_id'];

    // Define the relationship with the User model
    public function bookings()
    {
        return $this->belongsTo(Booking::class);
    }
    public function enquiries()
    {
        return $this->belongsTo(Enquiry::class);
    }
	
}
