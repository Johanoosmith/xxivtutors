<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Booking;
use App\Models\Subject;
use App\Models\SubjectTutor;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\PaymentMethod;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\StripeService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BookingMailController;



class BookingController extends Controller
{
	protected $stripeService;
	// protected $siteEnvironment;
	// protected $stripeKey;
	// protected $stripeSecret;

	protected $client;

	public function __construct(StripeService $stripeService)
	{
		// $this->siteEnvironment = config('stripe.ENV');
		// if($this->siteEnvironment == 'production'){
		// $this->stripeKey	= config('stripe.STRIPE_KEY');
		// $this->stripeSecret = config('stripe.STRIPE_SECRET');
		// }else{
		// $this->stripeKey	= config('stripe.STRIPE_TEST_KEY');
		// $this->stripeSecret = config('stripe.STRIPE_TEST_SECRET');
		// }

		$this->stripeService = $stripeService;

		$this->client = new Client();
	}

	public function index(Request $request)
	{

		$perPage = 10; // Adjust as necessary

		$user_id = Auth::user()->id;

		// Create a new query for the Subject model
		$query = Booking::query();

		$booking_on = [
			'upcoming' => 'Upcoming Booking',
			'past'	   => 'Previous Booking',
			'cancel'   => 'Cancel Booking',
		];

		$query->where('student_id', $user_id)->with(['Tutor', 'Student', 'Subject', 'Level']);


		if (!empty($request->booking_on) && $request->booking_on == 'past') {
			// Past Records 
			$query->where(function ($q) {
				$q->where('start_date', '<', now()->toDateString())
					->orWhere(function ($subQ) {
						$subQ->where('start_date', now()->toDateString())
							->where('start_time', '<', now()->format('H:i:s'));
					});
			})->orderBy('start_date', 'DESC')->orderBy('start_time', 'DESC');
		} else {
			// Upcoming by default
			$query->where(function ($q) {
				$q->where('start_date', '>', now()->toDateString())
					->orWhere(function ($subQ) {
						$subQ->where('start_date', now()->toDateString())
							->where('start_time', '>=', now()->format('H:i:s'));
					});
			})->orderBy('start_date', 'ASC')->orderBy('start_time', 'ASC');
		}

		if (!empty($request->booking_on) && $request->booking_on == 'cancel') {
			$query->where('status', 3);
		} else {
			$query->whereIn('status', [1, 2]);
		}


		// Paginate the query results
		$bookings = $query->paginate($perPage);

		$booking_json = $this->getBookingsJson();

		return view('customer.booking.index', compact('bookings', 'booking_json', 'booking_on'));
	}


	public function getBookingsJson()
	{
		$now = Carbon::now();
		$startRange = $now->copy()->subMonths(6)->startOfDay();
		$endRange = $now->copy()->addMonths(6)->endOfDay();

		$bookings = Booking::whereBetween('start_date', [$startRange, $endRange])->get();

		$events = [];

		foreach ($bookings as $booking) {
			$startDateTime = Carbon::parse($booking->start_date . ' ' . $booking->start_time);

			$isPast = $startDateTime->lt($now);

			$events[] = [
				'title' => $booking->tutor->full_name . ' @ ' . date('H:i', strtotime($booking->start_time)),
				'start' => $startDateTime->toIso8601String(),
				'end' => $startDateTime->toIso8601String(),
				'url'   => $isPast ? '' : '',
				'className' => $isPast ? 'bg-secondary text-light' : 'bg-success text-white',
			];
		}
		return $events;
		//return response()->json($events);
	}



	public function view(Booking $booking)
	{
		return view('customer.booking.view', compact('booking'));
	}



	public function cancel(Request $request)
	{

		$user_id = Auth::user()->id;
		$booking = Booking::where('student_id', $user_id)
			->where('start_date', '>=', Carbon::now()->toDateString())
			->where('start_time', '>', Carbon::now()->toTimeString())
			->findOrFail($request->booking_id);

		$booking->status	= 3;
		$booking->cancel_by = 'Lesson cancel by student.';
		$booking->save();

		$mailController = new BookingMailController();

		$mailController->sendTutorBookingRelatedMail($booking, 'TUTOR_BOOKING_CANCELLATION');


		return redirect()->route('customer.booking.index')->with('success', 'Booking cancelled successfully.');
	}

	public function confirmed(Request $request)
	{

		$user_id = Auth::user()->id;
		// $booking = Booking::where('student_id',$user_id)
		// 				->where('start_date','>=',Carbon::now()->toDateString())
		// 				->where('start_time','>',Carbon::now()->toTimeString())
		// 				->findOrFail($request->id);

		$booking = Booking::with(['subject', 'level', 'student', 'tutor']) // eager load relationships
			->where('student_id', $user_id)
			->where('start_date', '>=', Carbon::now()->toDateString())
			->where('start_time', '>', Carbon::now()->toTimeString())
			->findOrFail($request->id);
		if ($booking) {
			$booking->status = 2; // Confirm Booking
			$booking->save();
			$mailController = new BookingMailController();
			$mailController->sendTutorBookingRelatedMail($booking, 'TUTOR_BOOKING_CONFIRMATION');
			$mailController->sendStudentBookingRelatedMail($booking, 'STUDENT_BOOKING_CONFIRMATION');
		}
		return redirect()->route('customer.booking.index')->with('success', 'Booking is confirmed successfully.');
	}


	public function payment_details(Request $request)
	{
		$user	=	Auth::user();
		$user_id =	$user->id;

		$payment_details = PaymentDetail::where('user_id', $user_id)->first();
		$payment_methods = PaymentMethod::where('user_id', $user_id)->first();

		if ($request->isMethod('post')) {

			if (empty($payment_details)) {
				$payment_details = new PaymentDetail();
			}

			if (empty($payment_methods)) {
				$payment_methods = new PaymentMethod();
			}



			$request->validate([
				//'card_type'            => 'required|in:Visa,MasterCard,Maestro,VisaElectron', // Allowed types
				//'card_number'          => 'required|numeric|digits_between:13,19', // Card numbers usually range from 13-19 digits
				//'expiry_date'          => 'required|date_format:m/Y|after:today', // Expiry date in MM/YYYY format
				//'expiry_date'          => 'required', // Expiry date in MM/YYYY format
				//'security_code'        => 'required|numeric|digits_between:3,4', // CVV is usually 3 or 4 digits
				'cardholder_first_name' => 'required|string|max:50',
				'cardholder_last_name' => 'required|string|max:50',
				'address'              => 'required|string|max:255',
				'city'                 => 'required|string|max:100',
				'county_id'            => 'required|integer', // Ensure county exists
				'country_id'           => 'required|integer', // Ensure country exists
				'postcode'             => 'required|string|max:20',
			]);


			$payment_details->user_id 			= $user_id;
			//$payment_details->card_type 		= $request->card_type;
			//$payment_details->card_number 	= $request->card_number;
			//$payment_details->expiry_date 	= $request->expiry_date;
			//$payment_details->security_code 	= $request->security_code;
			$payment_details->cardholder_first_name = $request->cardholder_first_name;
			$payment_details->cardholder_last_name = $request->cardholder_last_name;
			$payment_details->address 			   = $request->address;
			$payment_details->city 				   = $request->city;
			$payment_details->county_id 		   = $request->county_id;
			$payment_details->country_id 		   = $request->country_id;
			$payment_details->postcode			   = $request->postcode;
			$payment_details->save();

			if (!empty($request->payment_method_id)) {
				if (empty($payment_methods->customer_id)) {

					$customer	= [
						'email' => $user->email,
						'name'	=> $user->full_name
					];


					$response = $this->stripeService->createCustomer($customer);
					if ($response['status'] == 1) {
						$payment_methods->customer_id = $response['data']->id;
					}
				}

				$payment_methods->user_id			= $user_id;
				$payment_methods->payment_method_id = $request->payment_method_id;

				if ($payment_methods->save()) {
					$attach_response = $this->stripeService->attachPaymentMethod($request->payment_method_id, $payment_methods->customer_id);

					if ($attach_response['status'] == 1) {
						PaymentMethod::where('user_id', $user_id)->update(['attach' => 1]);
					}
				}
			}


			return redirect()->route('customer.booking.payment_details')->with('success', 'Payment details successfully saved.');
		}

		$countries	= \App\Models\Country::getList();
		$counties	= \App\Models\County::getList();


		return view('customer.booking.payment_details', compact('payment_details', 'counties', 'countries', 'payment_methods'));
	}

	public function payment_history(Request $request)
	{
		$payment_history = '';
		return view('customer.booking.payment_history', compact('payment_history'));
	}

	public function online_lesson(Request $request)
	{
		$page_id = config('constants.SITE.ONLINE_LESSON_PAGE_ID');
		$page = \App\Models\Page::getPage($page_id);

		return view('customer.booking.online_lesson', compact('page'));
	}

	/* Run by kernal every day */
	public function studentLessonCharge()
	{
		$startTime	= Carbon::now()->subDay(); // 24 hours ago
		$endTime	= Carbon::now(); // Current time

		// Confirm Booking
		$bookings = Booking::where('status', 2)
			->whereBetween('start_date', [$startTime, $endTime])
			->whereDoesntHave('payments', function ($query) {
				$query->where('status', 'paid');
			})
			->get();

		dd($bookings);

		if ($bookings->isEmpty()) {
			Log::channel('booking')->info('No confirmed bookings found in the last 24 hours.');
			return;
		}

		foreach ($bookings as $booking) {
			try {
				$paymentMethod	= PaymentMethod::where('user_id', $booking->student_id)->with(['user'])->first();
				$paymentGateway = PaymentGateway::where('user_id', $booking->tutor_id)->with(['user'])->first();

				if (!$paymentMethod || !$paymentGateway) {
					throw new \Exception("Booking {$booking->id} has missing payment details for student ID: {$booking->student_id} or tutor ID: {$booking->tutor_id}");
				}

				$description = 'Charge for lesson booking ID: ' . $booking->id . ' from student: ' . $paymentMethod['user']['email'] . ' and transfer to: ' . $paymentGateway['user']['email'];

				$payment = new Payment();

				$payment->booking_id	= $booking->id;
				$payment->tutor_id		= $booking->tutor_id;
				$payment->student_id 	= $booking->student_id;
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
					'application_fee_amount' => $payment->application_fee,
					'description' 	 => $description
				];



				$response = $this->stripeService->paymentIntent($data);

				if ($response['status'] == 1) {
					$payment_update = [
						'payment_intent_id' => $response['data']->id,
						'latest_charge' => $response['data']->latest_charge,
					];
					if ($response['data']->status == 'succeeded') {
						$payment_update['status'] = 'paid';
					}

					Payment::where('id', $payment->id)->update($payment_update);
				}

				Log::channel('booking')->info("Payment processed for booking ID: {$booking->id}", [
					'payload' => $data,
					'response' => $response

				]);
			} catch (\Exception $e) {
				Log::channel('booking')->error("Payment failed for booking ID: {$booking->id}. Error: " . $e->getMessage(), [
					'payload' => $data
				]);

				continue; /* Move to next booking */
			}
		}
	}



	public function stripe_account_create(Request $request)
	{

		$response = [];
		if (isset($_GET['delete_account'])) {
			$response = $this->stripeService->deleteAccount($_GET['delete_account']);
			dd('delete', $response);
		}

		//$this->retrieve_balance();
		//$response = $this->create_token();

		//$response = $this->stripeService->charge();

		if (isset($_GET['action']) && $_GET['action'] == 'student_payment') {
			$response = $this->studentLessonCharge();
		}

		if (isset($_GET['action']) && $_GET['action'] == 'payment') {
			$data['payment_method'] = 'pm_1QyX2JH9Na9kfkgFoIZNXV5w';
			$data['customer']		= 'cus_RsHMi4xa9s8Ril';
			$response = $this->stripeService->paymentIntent($data);
		}

		if (isset($_GET['action']) && $_GET['action'] == 'create_payment_method') {
			$data = [
				'number'	=> 4242424242424242,
				'exp_month'	=> 11,
				'exp_year'	=> 2027,
				'cvc'		=> 123,
			];
			$response = $this->stripeService->createPaymentMethod($data);
		}

		if (isset($_GET['action']) && $_GET['action'] == 'create_customer') {
			$data['email']	= 'customer@gmail.com';
			$data['name']	= 'Customer Test';

			$response = $this->stripeService->createCustomer($data);
		}

		if (isset($_GET['action']) && $_GET['action'] == 'attach_pm') {
			$response = $this->stripeService->attachPaymentMethod('pm_1QyX2JH9Na9kfkgFoIZNXV5w', 'cus_RsHMi4xa9s8Ril');
		}



		if (isset($_GET['action']) && $_GET['action'] == 'payment_confirm') {
			$response = $this->stripeService->paymentIntentConfirm('pi_3QyShxH9Na9kfkgF0pHOsOuF');
		}

		//$response = $this->stripeService->transfer();
		//$response = $this->stripeService->chargeRetrieve();
		//$response = $this->stripeService->updateAccount('','');

		if (isset($_GET['action']) && $_GET['action'] == 'create') {
			$response = $this->create_account();
		}

		dd('paymentIntent', $response);

		dd('Test');
	}

	/*
	public function create_account(){
		
		$auth_user = Auth::user();
		//$auth_user_id = $auth_user->id;
		$auth_user_id = 164;
		$user   = User::where('id',$auth_user_id)->with(['tutor'])->first()->toArray(); 
		
		$country= \App\Models\Country::where('id',$user['tutor']['country'])->first();
		$county	= \App\Models\County::where('id',$user['tutor']['county'])->first();
		
		$data = [
			'first_name'=>$user['firstname'],
			'last_name' =>$user['lastname'],
			'email' 	=> $user['email'],
			'phone'		=> $user['mobile'],
			'dob_day'	=> $user['dob_day'],
			'dob_month' => $user['dob_month'],
			'dob_year'	=> $user['dob_year'],
			'address_line1' => $user['address'],
			'city' 			=> $user['tutor']['town'],
			'state' 		=> $county['name'],
			'postal_code' 	=> $user['postcode'],
			'company'		=> $user['username'],
			'country' 		=> !empty($country) ? $country->code2l : 'GB',
		];
		
		
		$response	= $this->stripeService->createAccount($data);
		
		if($response['status'] == 1){
			$link_response	= $this->stripeService->accountLinks($response['data']->id);
			
			if($link_response['status'] == 1){
				$paymentGatway = new \App\Models\PaymentGateway();
				
				$paymentGatway->user_id			= $auth_user_id;
				$paymentGatway->account_id		= $response['data']->id;
				$paymentGatway->email 			= $user['email'];
				$paymentGatway->currency 		= 'GBP';
				$paymentGatway->account_link_url= $link_response['url'];
				$paymentGatway->save();
			}
		}
		
		return redirect()->route('login');
	}
	*/

	public function create_token()
	{


		$cardDetail = [
			'card' => [
				'number' => '4242424242424242',
				'exp_month' => '5',
				'exp_year' => '2026',
				'cvc' => '314',
			]
		];


		//$cardDetail = [ 'card' => 'tok_visa'];

		$response = $this->stripeService->createToken($cardDetail);

		dd('create_token', $response);
	}

	public function retrieve_balance()
	{
		$response = $this->stripeService->balance();
		$balance = $response['data']->available[0]->amount;
		pr($response);
		pr($response['data']->available[0]->amount);
	}

	public function stripe_payment() {}

	public function stripe_refresh_url(Request $request)
	{
		Log::warning('stripe_refresh_url', $_REQUEST);
		return redirect()->route('login');
	}

	public function stripe_return_url(Request $request)
	{
		Log::warning('stripe_return_url', $_REQUEST);
		return redirect()->route('login');
	}

	/*
	public function getSubjectByCourse($course_id, $selected_id=NULL)
    {
        $subjectObj = new Subject();
		$subjects = $subjectObj->getSubjectByCourse($course_id);
        return view('customer.booking.get_subject_by_course',compact('subjects','selected_id'));
    }
	*/

	/* You will get level and rate fields */
	/*
	public function getFieldsByCourse($course_id, $selected_id=NULL)
    {
		$request = request();
		if($request->ajax()){
			$course	= Course::where('status',1)->where('id',$course_id)->first();
			$course_levels = [];
			$levels = [];
			if(!empty($course)){
				$course_levels  = Course::getCouseLevelList($course_id, 'id');
				if(!empty($course_levels)){
					$levels = \App\Models\Level::getLevelList($course_levels);
				}
			}
		
			return view('customer.booking.get_fields_by_course',compact('levels','course','selected_id'));
		}
    }
	*/
}
