<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingContract extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [];


    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function contract(){
        return $this->belongsTo(Contract::class);
    }
}