@extends('layouts.cms')
@section('content')
<section class="dashboard-with-sidebar">
    <div class="container">
            <div class="row"> 
                @include('layouts.student_tabs')
                <div class="col dashboard-content">
                    @include('elements.alert_message')
					@include('customer.booking.booking_tabs')
                    
					@if(!empty($payment_methods->payment_method_id))
						<div class="alert alert-success alert-dismissible alert-alt fade show">
							Payment method is settled no need to entered card details.
						</div>
					@endif
					
					<p>
						To confirm lessons with (Tutors name), please enter your payment details here. We will then validate your payment details and register your bank card with Stripe. No payments will be taken until after the first lesson. All payments will automatically be collected 24 hours after each lesson.
					</p>
					
					
					<form class="edit-form" id="PaymentForm" action="{{ route('customer.booking.payment_details') }}" method="POST">
						@csrf
						@method('POST')
						
						<div class="col-md-6">
							<div class="row">
								<!--
								<div class="col-12 form-field">
									<label class="form-label">Card Type</label> 
									<select name="card_type" class="form-control" required>
										@php 
											$card_types = ['Visa','Maestro','MasterCard','VisaElectron'];
										@endphp
										@foreach ($card_types  as $value)
											<option value="{{ $value }}" @selected(old('card_type',@$payment_details->card_type) == $value)>
												{{ $value }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-12 form-field">
									<label class="form-label">Card Number</label> 
									<input type="text" name="card_number" class="form-control numeric" value="{{ old('card_number',@$payment_details->card_number); }}">
								</div>
								<div class="col-12 form-field" >
									<label class="form-label">Expire Date(MM/YY) </label> 
									<input type="text" id="expiry_date" name="expiry_date" class="form-control" value="{{ old('expiry_date',@$payment_details->expiry_date); }}">
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Security Code</label>
									<input type="text" name="security_code" class="form-control numeric" value="{{ old('security_code',@$payment_details->security_code); }}">
								</div>
								-->
								
								<div class="col-12 form-field">
									<label class="form-label">Card</label>
									<div id="card-element"></div>
								</div>
								
								<input type="hidden" id="PaymentMethodId" name="payment_method_id" class="form-control" value="">
								
								<div class="col-12 form-field">
									<label class="form-label">Cardholder First Name</label>
									<input type="text" name="cardholder_first_name" class="form-control" value="{{ old('cardholder_first_name',@$payment_details->cardholder_first_name); }}">
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Cardholder Last Name</label>
									<input type="text" name="cardholder_last_name" class="form-control" value="{{ old('cardholder_last_name',@$payment_details->cardholder_last_name); }}">
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Address</label>
									<input type="text" name="address" class="form-control" value="{{ old('address',@$payment_details->address); }}">
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">City</label>
									<input type="text" name="city" class="form-control" value="{{ old('city',@$payment_details->city); }}">
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">County</label>
									<select name="county_id" class="form-control" required>
										<option value="">Choose County</option>
										@foreach ($counties  as $key => $value)
											<option value="{{ $key }}" @selected(old('county_id',@$payment_details->county_id) == $key)>
												{{ $value }}
											</option>
										@endforeach
									</select>
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Country</label>
									<select name="country_id" class="form-control" required>
										<option value="">Choose Country</option>
										@foreach ($countries  as $key => $value)
											<option value="{{ $key }}" @selected(old('country_id',@$payment_details->country_id) == $key)>
												{{ $value }}
											</option>
										@endforeach
									</select>
								</div>
								
								<div class="col-12 form-field">
									<label class="form-label">Postcode</label>
									<input type="text" name="postcode" class="form-control" value="{{ old('postcode',@$payment_details->postcode); }}">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-12">
								<button type="submit" id="SubmitButton" class="btn btn-green">Save</button>
							</div>
						</div>
					</form>
					
					<br/>
					<p><strong>Important:</strong> All lessons must be supervised by an parent or guardian for the duration of each tutoring session.</p>

					<h4>How Billings Works</h4>

					<p>To validate your payment details we will register your bank card with stripe. No payments will be taken until after the first lesson. All lesson payments get collected automatically, 24 hours after each lesson. Our payment provider is Stripe, one of the most popular and trusted online payment services. They use strong encryption to protect your credit card information. They are well known for their responsible privacy and security policies. We also use a secure connection (SSL) throughout the payment process.</p>
					
				</div>
            </div>
        </div>
</section>
@endsection


@section('page-js')
	<script src="https://js.stripe.com/v3/"></script>
@endsection


@section('custom-js')
	<script>
		const STRIPE_KEY = "{{ (config('stripe.ENV') == 'production') ? config('stripe.STRIPE_KEY') : config('stripe.STRIPE_TEST_KEY') }}";
		
		const stripe = Stripe(STRIPE_KEY); 
		const elements = stripe.elements();
		const cardElement = elements.create('card');
		cardElement.mount('#card-element');

		const form = document.getElementById("PaymentForm");
		form.addEventListener('submit', async (event) => {
            event.preventDefault();
            document.getElementById('SubmitButton').disabled = true;

            // Create a Payment Method
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: "card",
                card: cardElement,
            });

            if (error) {
				console.log('error');
				console.log(error);
				alert(error.message);
                //document.getElementById("payment-result").innerText = error.message;
                document.getElementById('SubmitButton').disabled = false;
            
			}else{
                console.log("Payment Method ID:", paymentMethod.id);
				//jQuery('[name="payment_method_id"]').val(paymentMethod.id);
				document.getElementById("PaymentMethodId").value = paymentMethod.id;
				
				//document.querySelector('[name="payment_method_id"]').addEventListener('input', function (e) {
				//	this.value = paymentMethod.id;
				//});
				
				form.submit();
                
            }
        });

		/*
		async function createPaymentMethod() {
			const { paymentMethod, error } = await stripe.createPaymentMethod({
				type: "card",
				card: cardElement,
			});

			if (error) {
				console.error(error.message);
			} else {
				console.log("Payment Method ID:", paymentMethod.id);
				sendToBackend(paymentMethod.id);
			}
		}
		*/
	</script>
@endsection