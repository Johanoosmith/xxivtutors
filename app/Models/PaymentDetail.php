<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable = [
							'user_id', 'card_type', 'card_number', 'expiry_date',
							'security_code','cardholder_first_name','cardholder_last_name','address',
							'city','county_id','country_id','postcode'
						];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	
}
