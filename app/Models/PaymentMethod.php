<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ['user_id', 'customer_id', 'payment_method_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
}
