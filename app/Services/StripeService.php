<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\User;

use Stripe\Stripe;
use Stripe\Account;

/*
	Stripe Fees: https://stripe.com/in/pricing
	API Doc: Doc: https://docs.stripe.com/api/
	Stripe Doc: https://docs.stripe.com

*/

class StripeService
{
    protected $siteEnvironment;
	protected $client;
	
	protected $stripeKey;
	protected $stripeSecret;
	
	protected $stripeObj;

    public function __construct()
    {
        $this->siteEnvironment = config('stripe.ENV');
		
		if($this->siteEnvironment == 'production'){
			$this->stripeKey	= config('stripe.STRIPE_KEY');
			$this->stripeSecret = config('stripe.STRIPE_SECRET');
		}else{
			$this->stripeKey	= config('stripe.STRIPE_TEST_KEY');
			$this->stripeSecret = config('stripe.STRIPE_TEST_SECRET');
		}

        $this->client	 = new Client();
        
		$this->init();
		
    }
	
	/* set the stripe object */
	public function init($stripe_secret = NULL)
	{
		if(!empty($stripe_secret)){
			$this->stripeSecret = $stripe_secret;
		}
		
		$this->stripeObj = new \Stripe\StripeClient($this->stripeSecret);	
	}
	
	
	
	/* Object to array */
	
	/*
		response---
		
		{
		  "object": "balance",
		  "available": [
			{
			  "amount": 666670,
			  "currency": "usd",
			  "source_types": {
				"card": 666670
			  }
			}
		  ],
		  "connect_reserved": [
			{
			  "amount": 0,
			  "currency": "usd"
			}
		  ],
		  "livemode": false,
		  "pending": [
			{
			  "amount": 61414,
			  "currency": "usd",
			  "source_types": {
				"card": 61414
			  }
			}
		  ]
		}
	*/
	
	public function balance()
	{
		$response = array();
		try {
			
			$response['data'] = $this->stripeObj->balance->retrieve([]);
			
			$response['status'] = 1;
		}
		catch(\Stripe\Error\ApiConnection $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		} 
		catch(\Stripe\Error\InvalidRequest $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		} 
		catch(\Stripe\Error\Api $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}catch(\Stripe\Error\Card $e) {
		  $response['status'] = 0;
		  $response['error']['text'] = $e->getMessage();
		}
		catch(\Stripe\Error\Authentication $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		} 
		catch(\Stripe\Error\Base $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		} 
		catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}
		
		return $response;
	}
	
	/*
		Response---
		{
		  "id": "tok_1N3T00LkdIwHu7ixt44h1F8k",
		  "object": "token",
		  "card": {
			"id": "card_1N3T00LkdIwHu7ixRdxpVI1Q",
			"object": "card",
			"address_city": null,
			"address_country": null,
			"address_line1": null,
			"address_line1_check": null,
			"address_line2": null,
			"address_state": null,
			"address_zip": null,
			"address_zip_check": null,
			"brand": "Visa",
			"country": "US",
			"cvc_check": "unchecked",
			"dynamic_last4": null,
			"exp_month": 5,
			"exp_year": 2026,
			"fingerprint": "mToisGZ01V71BCos",
			"funding": "credit",
			"last4": "4242",
			"metadata": {},
			"name": null,
			"tokenization_method": null,
			"wallet": null
		  },
		  "client_ip": "52.35.78.6",
		  "created": 1683071568,
		  "livemode": false,
		  "type": "card",
		  "used": false
		}
	
	*/
	
	public function createToken($cardDetail)
	{
		$response = array();
		try {
			
			//$astripeObj = new \Stripe\StripeClient($this->stripeSecret);
			//$token = $astripeObj->tokens->create($cardDetail);
			
			$token = $this->stripeObj->tokens->create($cardDetail);
			$response['status'] = 1;
			$response['token_id'] = $token->id;
		}
		catch (\Stripe\Error\ApiConnection $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			// Network problem, perhaps try again.
		} catch (\Stripe\Error\InvalidRequest $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			// You screwed up in your programming. Shouldn't happen!
		} catch (\Stripe\Error\Api $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			// Stripe's servers are down!
		}catch(\Stripe\Error\Card $e) {
		  $response['status'] = 0;
		  $response['error']['text'] = $e->getMessage();
		}
		
		return $response;
	}
	
	/* 
		-- Charge Payment
		
	*/
	public function charge(){
		
		/*
			id: ch_3QxR6LEUKMoPwrx80PQVGk4U
			balance_transaction: txn_3QxR6LEUKMoPwrx80eKrVRij
			source: {
				id: card_1QxR6LEUKMoPwrx8dUsWud5W
			}
		
		*/
		
		$charge = $this->stripeObj->charges->create([
			'amount' => 10000, // $100 in cents
			'currency' => 'usd',
			//'source' => $request->stripeToken, // Payment source from frontend
			'source' => 'tok_visa',
			'description' => 'Tutoring Session Payment',
		]);
		return $charge;
	}
	
	public function businessAccountCreate($user_id){
		
		$user   = User::where('id',$user_id)->with(['tutor'])->first()->toArray(); 
		
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
		
		
		$response	= $this->createAccount($data);
		
		if($response['status'] == 1){
			$link_response	= $this->accountLinks($response['data']->id);
			
			if($link_response['status'] == 1){
				$paymentGatway = new \App\Models\PaymentGateway();
				
				$paymentGatway->user_id			= $user_id;
				$paymentGatway->account_id		= $response['data']->id;
				$paymentGatway->email 			= $user['email'];
				$paymentGatway->currency 		= 'GBP';
				$paymentGatway->account_link_url= $link_response['url'];
				$paymentGatway->save();
			}
		}
		
		return redirect()->route('login');
	}
	
	public function chargeRetrieve(){
		
		/*
			id: ch_3QxR6LEUKMoPwrx80PQVGk4U
			balance_transaction: txn_3QxR6LEUKMoPwrx80eKrVRij
			source: {
				id: card_1QxR6LEUKMoPwrx8dUsWud5W
			}
		
		*/
		
		$charge = $this->stripeObj->charges->retrieve('ch_3QxR6LEUKMoPwrx80PQVGk4U', []);
		
		return $charge;
	}
	
	/*
		To use this, you need to enable access raw card from support team
		https://support.stripe.com/questions/enabling-access-to-raw-card-data-apis
	*/
	
	public function createPaymentMethod($data){
		$response = $this->stripeObj->paymentMethods->create([
						  'type' => 'card',
						  'card' => [
							'exp_month'	=> $data['exp_month'],
							'exp_year'	=> $data['exp_year'],
							'number'	=> $data['number'],
							'cvc'		=> $data['cvc'],
						  ],
						  //'billing_details' => ['name' => 'John Doe'],
						]);
						
		return $response;
	}
	
	public function attachPaymentMethod($payment_method_id, $customer_id){
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		
		try {
			
			$response = $this->stripeObj->paymentMethods->attach(
						  $payment_method_id,
						  ['customer' => $customer_id]
						);
						
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}
		return $response;
	}
	
	/*
		Doc: https://docs.stripe.com/api/payment_intents/object
	*/
	
	public function paymentIntent($data){
		
		/*
			Working but payment will not confirm, need to use paymentIntentConfirm
			$response = $this->stripeObj->paymentIntents->create(
								[
								  'amount' => 80 * 100,
								  'currency' => 'gbp',
								  'automatic_payment_methods' => ['enabled' => true, 'allow_redirects'=>'never'],
								  //'confirm' => true, // Ensures payment is completed
								  'description' => 'Tutor Lesson',
								  'application_fee_amount' => 20 * 100,
								  'transfer_data' => [
									'destination'=> 'acct_1QySX2HB7hATrFRF'
								  ]
								]
						);
		*/
		
		$response['status'] = 0;
		
		try{
			$response['data'] = $this->stripeObj->paymentIntents->create(
									[
									  'amount' 						=> $data['amount'] * 100,
									  'currency'					=> 'gbp',
									  'automatic_payment_methods'	=> ['enabled' => true, 'allow_redirects'=>'never'],
									  'confirm' 					=> true, // Ensures payment is completed,
									  'customer'					=> $data['customer'],
									  'payment_method'				=> $data['payment_method'],
									  'description'					=> $data['description'],
									  'application_fee_amount' 		=> $data['application_fee_amount'] * 100,
									  'transfer_data' 				=> [
																		'destination'=> $data['destination']
																	]
									]
								);
						
		
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			
			Log::info('Payment intent failed. '. $e->getMessage(), [
				'payload'=>$data
			]);
		}
		return $response;
		

		
	}
	
	public function paymentIntentConfirm($payment_intent_id){
		$response = $this->stripeObj->paymentIntents->confirm(
					  $payment_intent_id,
					  [
						'payment_method' => 'pm_card_visa',
						'return_url' => url('/stripe_return_url'),
					  ]
					);
					
		return $response;
	}
	
	public function transfer(){
		$response = $this->stripeObj->transfers->create([
		  'amount' => 10 * 100,
		  'currency' => 'usd',
		  'destination' => 'acct_1QxnSeH40VX7GP1J',
		]);
		
		dd('transfer', $response);
	}
	
	/* 
		-- Create Account 
		Doc: https://docs.stripe.com/api/accounts/create
	
		$stripe->accounts->create([
		  'country' => 'US',
		  'email' => 'jenny.rosen@example.com',
		  'controller' => [
				'fees' 	=> ['payer' => 'application'],
				'losses'=> ['payments' => 'application'],
				'stripe_dashboard' => ['type' => 'express'],
		  ],
		]);
	
	*/
	
	#Business type
	#Industry
	#Business website
	#Representative
	#Terms of service acceptance
	
	public function createAccount($data){
		
		/*
			purushottam.saini@dotsquares.com: acct_1QxnSeH40VX7GP1J
		*/
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		try {
			
			$response['data'] = $this->stripeObj->accounts->create(array(
											'type'=>'express',
											'country' => $data['country'],
											'email' => $data['email'],
											'capabilities' => [
												'card_payments' => ['requested' => true],
												'transfers' => ['requested' => true],
											],
											
											//'controller' => [
												//'fees' => ['payer' => 'application'],
												///'losses' => ['payments' => 'application'],
												//'stripe_dashboard' => ['type' => 'express'],
												//'requirement_collection'=>'stripe'
											//],
											
											'business_type'=>'individual',
											'business_profile'=>[
												'mcc'=>7299,
												//'url'=>url('/'),
												'url'=>url('/'),
											],
											'company'=>[
												'name'=>$data['company']
											],
											'individual' => [
												'first_name' => $data['first_name'],
												'last_name' => $data['last_name'],
												'email' => $data['email'],
												'phone' => $data['phone'],
												'dob' => [
													'day' 	=> $data['dob_day'],
													'month' => $data['dob_month'],
													'year'	=> $data['dob_year']
												],
												'address' => [
													'line1' => $data['address_line1'],
													'city'	=> $data['city'],
													'state' => $data['state'],
													'postal_code' => $data['postal_code'],
													'country' => $data['country']
												],
											],
											
											/*
											'tos_acceptance' => [
												'date' => time(),
												'ip' => $_SERVER['REMOTE_ADDR'] // Get user's IP
											],
											*/
											
										  )
										);
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			
			Log::info('Create account failed. '. $e->getMessage(), [
				'payload'=>$data
			]);
			
		}
		return $response;
	}
	
	public function createCustomer($data){
		
		/*
			jennyrosen@example.com: cus_RsHMi4xa9s8Ril
		*/
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		
		try {
			
			$response['data'] = $this->stripeObj->customers->create([
									  'name' => $data['name'],
									  'email' => $data['email'],
									]);
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
			
			Log::info('Create customer failed. '. $e->getMessage(), [
				'payload'=>$data
			]);
		}
		return $response;
	}
	
	
	public function updateAccount($account_id, $data){
		
		/*
			acct_1QxkZYQjEG26cDEC
		*/
		
		$account_id = 'acct_1QxkZYQjEG26cDEC';
		$data 		= [
						'capabilities' => [
							'card_payments' => ['requested' => true],
							'transfers' => ['requested' => true],
						]
					];
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		try {
			
			$response['data'] = $this->stripeObj->accounts->update($account_id, $data);
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}
		return $response;
	}
	
	/* Retrieve Account Details */
	public function retrieveAccount($stripe_id,$account_id){
		
		$this->init($stripe_id);
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		try {
			$result = $this->stripeObj->financialConnections->accounts->retrieve($account_id, []);
			
			$response['data'] = $result;
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}
		
		return $response;
	}
	
	
	public function deleteAccount($account_id){
		return $this->stripeObj->accounts->delete($account_id, []);
	}
	
	/*
		Account Links
		Doc: https://docs.stripe.com/api/account_links
		Response:
		{
		  "object": "account_link",
		  "created": 1680577733,
		  "expires_at": 1680578033,
		  "url": "https://connect.stripe.com/setup/c/acct_1Mt0CORHFI4mz9Rw/TqckGNUHg2mG"
		}
	*/
	
	public function accountLinks($account_id){
		
		$response['status'] = 0;
		$response['error']['text'] = '';
		try {
			
			$response['data'] = $this->stripeObj->accountLinks->create([
								  'account' => $account_id,
								  'refresh_url' => url('/stripe/refresh_url'),
								  'return_url' => url('/stripe/return_url'),
								  'type' => 'account_onboarding',
								]);
			$response['status'] = 1;
		}catch(Exception $e) {
			$response['status'] = 0;
		  	$response['error']['text'] = $e->getMessage();
		}
					
		return $response;
	}
	
	/*
    public function getProducts()
    {
        try {
            $response = $this->client->request('GET', "https://{$this->storeDomain}/admin/api/2024-01/products.json", [
                'headers' => [
                    'X-Shopify-Access-Token' => $this->accessToken,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getHeaders(){
        return [
            'Authorization' => 'ApiKey key="'.$this->coniqApiKey.'"',
            'Content-type'=> 'application/json',
            'x-api-version' =>'2.0'
        ];
    }

    public function getSubscription($customer_email)
    {
        try {

            $headers = $this->getHeaders();

            $params = [
                'customer_email' => $customer_email,
                'offer_id'       => $this->coniqOfferID,  //loyalty_id RND check
            ];

            // Make the GET request with headers and query params
            //$url = $this->coniqApiUrl . '/subscription?customer_email='.$customer_email.'&offer_id='.$this->coniqOfferID;
            
            $custom_data = Http::withHeaders($headers)->get($this->coniqApiUrl . '/subscription', $params)->json();

            return !empty($custom_data[0]) ? $custom_data[0] : [];
            
        } catch (\Exception $e) {
            Log::info('Subscription Retrieve API Call Failed', [
                'error' => $e->getMessage(),
                'payload' => $params,
            ]);
        }
    }
	*/


}
