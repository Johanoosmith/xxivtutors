<?php

return [    
    'ENV' 			=> env('APP_ENV', 'production'),
    'STRIPE_KEY' 	=> env('STRIPE_KEY'),
    'STRIPE_SECRET' => env('STRIPE_SECRET'),
	'STRIPE_TEST_KEY'	=> env('STRIPE_TEST_KEY'),
    'STRIPE_TEST_SECRET'=> env('STRIPE_TEST_SECRET'),
];

?>