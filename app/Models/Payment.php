<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Services\StripeService;

class Payment extends Model
{
    protected $fillable = [
							'booking_id', 'tutor_id', 'student_id', 'payment_method_id',
							'payment_intent_id','latest_charge','currency','application_fee',
							'payment_platform_fee','tutor_amount','final_amount','status'
						];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
	
	public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
	
	public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
	
	/* Run by kernal every day */
	public function studentLessonCharge(){
		
		$startTime	= Carbon::now()->subDay(); // 24 hours ago
		$endTime	= Carbon::now(); // Current time
		
		// Confirm Booking
		$bookings = \App\Models\Booking::where('status', 2)  
			->whereBetween('start_date', [$startTime, $endTime])
			->whereDoesntHave('payments', function ($query) {
				$query->where('status', 'paid');
			})
			->get();
			
		

        if ($bookings->isEmpty()) {
            Log::channel('booking')->info('No confirmed bookings found in the last 24 hours.');
            return;
        }
		
		$stripeServiceObj = new StripeService();

        foreach ($bookings as $booking) {
            try {
					$paymentMethod	= PaymentMethod::where('user_id', $booking->student_id)->with(['user'])->first();
					$paymentGateway = PaymentGateway::where('user_id', $booking->tutor_id)->with(['user'])->first();
					
					if (!$paymentMethod || !$paymentGateway) {
						throw new \Exception("Booking {$booking->id} has missing payment details for student ID: {$booking->student_id} or tutor ID: {$booking->tutor_id}");
					}
					
					$description = 'Charge for lesson booking ID: '.$booking->id.' from student: '. $paymentMethod['user']['email'] . ' and transfer to: '.$paymentGateway['user']['email'];
					
					$payment = new Payment();
					
					$payment->booking_id	= $booking->id;
					$payment->tutor_id		= $booking->tutor_id;
					$payment->student_id 	= $booking->student_id ;
					$payment->payment_method_id = $paymentMethod->payment_method_id;
					
					$payment->currency 				= config('constants.SITE.CURRENCY');
					$payment->application_fee		= $booking->student_rate - $booking->hourly_rate;
					$payment->payment_platform_fee	= 0.00;
					$payment->tutor_amount 		   	= $booking->hourly_rate;
					$payment->charge_amount		   	= $booking->student_rate;
					$payment->status		   		= 'pending';
					
					$payment->save();
					
					$data = [
								'payment_method' => $paymentMethod->payment_method_id,
								'customer'		 => $paymentMethod->customer_id,
								'destination'	 => $paymentGateway->account_id,
								'amount'		 => $payment->charge_amount,	
								'application_fee_amount'=> $payment->application_fee,
								'description' 	 => $description
							];
				
					$response = $stripeServiceObj->paymentIntent($data);
					
					if($response['status'] == 1){
						$payment_update = [
							'payment_intent_id' => $response['data']->id,
							'latest_charge' => $response['data']->latest_charge,
						];
						if($response['data']->status == 'succeeded'){
							$payment_update['status'] = 'paid'; 
						}
						
						Payment::where('id',$payment->id)->update($payment_update);
					}else{
						/* 
							1. Send mail of unpaid lesson to tutor
							2. Cancel all upcoming lesson with that student & tutor 
									a.) Message: Cancel lesson by the system because of unpaid last lesson payment : Booking id - 
							3. Send mail of stripe issue to student
						
						*/
						
					}
					
				Log::channel('booking')->info("Payment processed for booking ID: {$booking->id}", [
					'payload' => $data,
					'response'=>$response
				]);
				
            } catch (\Exception $e) {
                Log::channel('booking')->error("Payment failed for booking ID: {$booking->id}. Error: " . $e->getMessage(), [
					'payload' => $data
				]);
				
				continue; /* Move to next booking */
            }
		}
		
	}
	
}
