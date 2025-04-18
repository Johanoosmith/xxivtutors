<?php
use Config as config;
use App\Models\Option;
use App\Models\User;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Country;
use App\Models\City;
use App\Models\Currency;
use App\Models\Transportorder;
use App\Models\Transportctorder;
use App\Models\Transportqfcorder;
use App\Models\Transportoborder;
use App\Models\News;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Level;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Notifications\CustomEmailNotification;
use Illuminate\Support\Facades\Notification;


function sendMail($email, $data, $slug){
	$site_var = getSiteVariable();
	$data	  = array_merge($data, $site_var);
	
	// comment this line because of stream_socket_enable_crypto is not proper set up
	Notification::route('mail', $email)->notify(new CustomEmailNotification($email, $data, $slug));
}

function getSiteVariable(){
	return [
		'site_name'=>'MyProTutor',
		'support_email'=>'support@tutor.com'
	];
}


function getCityCourses($cityid){
	return Course::where('status',1)->whereRaw('FIND_IN_SET(?, cities)', [$cityid])->get();
}

function getCitySubjects($cityid){
	return Subject::where('status',1)->whereRaw('FIND_IN_SET(?, cities)', [$cityid])->get();
}

function getUserViewCounts($userId) {
    return [
        'all_views' => DB::table('user_views')
            ->where('user_id', $userId)
            ->sum('view'),

        'last_7_days' => DB::table('user_views')
            ->where('user_id', $userId)
            ->where('date', '>=', Carbon::now()->subDays(7)->toDateString())
            ->sum('view'),

        'current_month' => DB::table('user_views')
            ->where('user_id', $userId)
            ->whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('view'),

		'last_14_days' => DB::table('user_views')
		->selectRaw('DATE(date) as date, SUM(view) as total_views')
		->where('user_id', $userId)
		->where('date', '>=', Carbon::now()->subDays(14)->toDateString())
		->groupBy('date')
		->orderBy('date', 'desc')
		->get(),

        'last_2_months' => DB::table('user_views')
            ->where('user_id', $userId)
            ->whereBetween('date', [
                Carbon::now()->subMonths(2)->startOfMonth()->toDateString(),
                Carbon::now()->subMonth()->endOfMonth()->toDateString()
            ])
            ->sum('view'),
    ];
	
}
function getlastforteenView($userId)
	{
		// Generate an array of the past 14 days (including today)
		$last14Days = collect(range(0, 13))->map(function ($day) {
			return Carbon::today()->subDays($day)->toDateString();
		});
		// Fetch views from the database for the past 14 days
		$views = DB::table('user_views')
			->selectRaw('DATE(date) as date, SUM(view) as total_views')
			->where('user_id', $userId)
			->where('date', '>=', Carbon::today()->subDays(13)->toDateString())
			->groupBy(DB::raw('DATE(date)'))
			->pluck('total_views', 'date'); // Key-value pairs (date => total_views)

		// Merge the two to ensure all days are accounted for
		return $last14Days->map(function ($date) use ($views) {
			return [
				'date' => $date,
				'total_views' => $views[$date] ?? 0, // Default to 0 if no views exist for the date
			];
		});
	}
/** get all setting  */
function getSettings($type) {
	$options = Option::where(['type' => $type])->get();
	$settings =  array();
	if ($options) {
		foreach ($options as $option) {
			$settings[$option->option_key] = $option->option_value;
		}
	}
	return $settings;
}

/** get admin  name */
function getAdminDetail() {
	return User::find(101);	
}

function getHeaderMenu($id){
	return Menu::where('id', '=', $id)->get();	
}

function getFooterMenu($id){
	return Menu::where('id', '=', $id)->get();
}

function getUrlByPageID($id) {
	$slug_arr = Page::where('id', '=', $id)->get('page_url')->toArray();
	$url = 'javascript:void(0);';
	if(!empty($slug_arr)){
		$url =  url($slug_arr[0]['page_url']);
	}
	return $url;
}

function getSlugById( $id, $model) {  
		$data = Page::find($id);
		if(isset($data->page_url)){
			return $data->page_url;
		}
		return "javascript:void(0);";
	
} 

function pr($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

function getCityCountryDetail( $country_id, $city_id) {  
	$country = Country::find($country_id);
	$city = City::find($city_id);
	$country_name = $city_name = '';

	if(!empty($country)){
		$country_name = $country->name;
	}
	if(!empty($city)){
		$city_name = $city->name;
	}
	//echo $city_name.', '.$country_name;
	
	return $city_name.', '.$country_name;
	
} 
function generateOrderIdold($id,$serviceType = null){
	
	//TR.01072024.VK.C.TBLGE-LNDUK
	$serviceTypes = [
		1 => Transportorder::class,
		2 => Transportctorder::class,
		3 => Transportqfcorder::class,
		4 => Transportoborder::class
	];
	
	if (isset($serviceTypes[$serviceType])) {
		$transportorder = $serviceTypes[$serviceType]::find($id);
	} else {
		// Handle the case where $serviceType is not valid
		throw new Exception("Invalid service type");
	}
	

    $step3_name 	= 	'';
	$step3_surname  = 	'';
	$step2_species  = 	'';
	if(!empty($transportorder->step3_name)){
		$step3_name = strtoupper($transportorder->step3_name[0]);
	}

	if(!empty($transportorder->step3_surname)){
		$step3_surname = strtoupper($transportorder->step3_surname[0]);
	}

	if(!empty($transportorder->step2_species)){
		$step2_species = strtoupper($transportorder->step2_species[0]);
	}


	
	$dep_country_id             =  $transportorder->departure_country_id;
	$dep_city_id                =  $transportorder->departure_city_id;
	$dest_country_id            =  $transportorder->destination_country_id;
	$dest_city_id               =  $transportorder->destination_city_id;

	$travel_date        = Date("dmY",strtotime($transportorder->pets_travel_date));
	$custom_order_id = '';

	$departure_code           =  getCityCountryShortName($dep_city_id);
	$destination_code         =  getCityCountryShortName($dest_city_id);

	if($transportorder->service_type == 1){		
		$custom_order_id = 'TR.'. $travel_date;
	}elseif($transportorder->service_type == 2){	
		$custom_order_id = 'CT.'. $travel_date;
	}elseif($transportorder->service_type == 4){	
		$custom_order_id 	= 'OB.'. $travel_date;
	}
		
	if(!empty($step3_name)){
		$custom_order_id .= '.'.$step3_name;
	}
	if(!empty($step3_surname)){
		$custom_order_id .= $step3_surname;
	}
	if(!empty($step2_species)){
		$custom_order_id .= '.'.$step2_species;
	}
	if(!empty($departure_code)){
		$custom_order_id .= '.'.$departure_code;
	}
	if(!empty($destination_code)){
		$custom_order_id .= '-'.$destination_code;
	}

	if($transportorder->service_type == 2){		
		$custom_order_id .= '.'.$transportorder->step2_ct_consultation_time;
	}
	

	 return $custom_order_id;

}
function generateOrderId($id,$serviceType = null){
	//TR.01072024.VK.C.TBLGE-LNDUK
	$transportorder = 	Transportorder::find($id);
    $step3_name 	= 	'';
	$step3_surname  = 	'';
	$step2_species  = 	'';
	if(!empty($transportorder->step3_name)){
		$step3_name = strtoupper($transportorder->step3_name[0]);
	}

	if(!empty($transportorder->step3_surname)){
		$step3_surname = strtoupper($transportorder->step3_surname[0]);
	}

	if(!empty($transportorder->step2_species)){
		$step2_species = strtoupper($transportorder->step2_species[0]);
	}
	
	$dep_country_id             =  $transportorder->departure_country_id;
	$dep_city_id                =  $transportorder->departure_city_id;
	$dest_country_id            =  $transportorder->destination_country_id;
	$dest_city_id               =  $transportorder->destination_city_id;
	$travel_date        		=  Date("dmY",strtotime($transportorder->pets_travel_date));
	$custom_order_id 			=  '';

	$departure_code           =  getCityCountryShortName($dep_city_id);
	$destination_code         =  getCityCountryShortName($dest_city_id);

	$custom_order_id = 'TR.'. $travel_date;
		
	if(!empty($step3_name)){
		$custom_order_id .= '.'.$step3_name;
	}
	if(!empty($step3_surname)){
		$custom_order_id .= $step3_surname;
	}
	if(!empty($step2_species)){
		$custom_order_id .= '.'.$step2_species;
	}
	if(!empty($departure_code)){
		$custom_order_id .= '.'.$departure_code;
	}
	if(!empty($destination_code)){
		$custom_order_id .= '-'.$destination_code;
	}

	if($transportorder->service_type == 2){		
		$custom_order_id .= '.'.$transportorder->step2_ct_consultation_time;
	}
	

	 return $custom_order_id;

}
function generateCTOrderId($id,$serviceType = null){
	//TR.01072024.VK.C.TBLGE-LNDUK
	$transportorder = 	Transportctorder::find($id);
    $step2_ct_name 	= 	'';
	$step2_ct_surname  = 	'';
	$step2_species  = 	'';
	if(!empty($transportorder->step2_ct_name)){
		$step2_ct_name = strtoupper($transportorder->step2_ct_name[0]);
	}

	if(!empty($transportorder->step2_ct_surname)){
		$step2_ct_surname = strtoupper($transportorder->step2_ct_surname[0]);
	}

	if(!empty($transportorder->step2_ct_species)){
		$step2_species = strtoupper($transportorder->step2_ct_species[0]);
	}
	
	$dep_country_id             =  $transportorder->departure_country_id;
	$dep_city_id                =  $transportorder->departure_city_id;
	$dest_country_id            =  $transportorder->destination_country_id;
	$dest_city_id               =  $transportorder->destination_city_id;
	$travel_date        		=  Date("dmY",strtotime($transportorder->pets_travel_date));
	$custom_order_id 			=  '';

	$departure_code           =  getCountryShortName($dep_city_id);
	$destination_code         =  getCountryShortName($dest_city_id);

	$custom_order_id = 'CT.'. $travel_date;		
	$custom_order_id .= '.'.$step2_ct_name;
	$custom_order_id .= $step2_ct_surname;
	$custom_order_id .= '.'.$step2_species;
	if(!empty($departure_code)){
		$custom_order_id .= '.'.$departure_code;
	}
	if(!empty($destination_code)){
		$custom_order_id .= '-'.$destination_code;
	}

	if($transportorder->service_type == 2){		
		$custom_order_id .= '.'.$transportorder->step2_ct_consultation_time;
	}
	

	 return $custom_order_id;

}
function generateOBOrderId($id,$serviceType = null){
	//TR.01072024.VK.C.TBLGE-LNDUK
	$transportorder = 	Transportoborder::find($id);
    $step3_name 	= 	'';
	$step3_surname  = 	'';
	$step2_species  = 	'';
	if(!empty($transportorder->step3_name)){
		$step3_name = strtoupper($transportorder->step3_name[0]);
	}

	if(!empty($transportorder->step3_surname)){
		$step3_surname = strtoupper($transportorder->step3_surname[0]);
	}

	if(!empty($transportorder->step2_species)){
		$step2_species = strtoupper($transportorder->step2_species[0]);
	}


	
	$dep_country_id             =  $transportorder->departure_country_id;
	$dep_city_id                =  $transportorder->departure_city_id;
	$dest_country_id            =  $transportorder->destination_country_id;
	$dest_city_id               =  $transportorder->destination_city_id;
	$travel_date        		=  Date("dmY",strtotime($transportorder->pets_travel_date));
	$custom_order_id 			=  '';

	$departure_code           =  getCityCountryShortName($dep_city_id);
	$destination_code         =  getCityCountryShortName($dest_city_id);

	$custom_order_id 	= 'OB.'. $travel_date;
		
	if(!empty($step3_name)){
		$custom_order_id .= '.'.$step3_name;
	}
	if(!empty($step3_surname)){
		$custom_order_id .= $step3_surname;
	}
	if(!empty($step2_species)){
		$custom_order_id .= '.'.$step2_species;
	}	
	if(!empty($departure_code)){
		$custom_order_id .= '.'.$departure_code;
	}
	if(!empty($destination_code)){
		$custom_order_id .= '-'.$destination_code;
	}
	if(!empty($transportorder->admin_traveltime)){
		$custom_order_id .= '-'.$transportorder->admin_traveltime;
	}
	
	 return $custom_order_id;

}
function generateQFCOrderId($id,$serviceType = null){
	//TR.01072024.VK.C.TBLGE-LNDUK
	$transportorder = 	Transportqfcorder::find($id);
    $name 		= 	'';
	$surname  	= 	'';
	$type  		= 	'';
	$species  	= 	'';
	$custom_order_id 			=  '';
	if($transportorder->qfc_check_type == "QC"){
		$type = "QC";
		$custom_order_id = $type;
	}

	if($transportorder->qfc_check_type == "QFC"){
		$type = "FC";
		$custom_order_id = $type;
	}
	
	if($transportorder->pets_travel_date){		
		$travel_date        = Date("dmY",strtotime($transportorder->pets_travel_date));
		$custom_order_id .= '.'.$travel_date;
	}


	if(!empty($transportorder->owner_name)){
		$name = strtoupper($transportorder->owner_name[0]);
		$custom_order_id .= '.'.$name;
	}

	if(!empty($transportorder->owner_surname)){
		$surname = strtoupper($transportorder->owner_surname[0]);
		$custom_order_id .= $surname;
	}

	if(!empty($transportorder->step2_species)){
		$species = strtoupper($transportorder->step2_species[0]);
		$custom_order_id .= '.'.$species;
	}


	
	$dep_country_id     =  $transportorder->departure_country_id;
	$dep_city_id        =  $transportorder->departure_city_id;
	$dest_country_id    =  $transportorder->destination_country_id;
	$dest_city_id       =  $transportorder->destination_city_id;	
	$departure_code     =  getCountryShortName($dep_country_id);
	$destination_code   =  getCountryShortName($dest_country_id);	
	
	if(!empty($departure_code)){
		$custom_order_id .= '.'.$departure_code;
	}
	if(!empty($destination_code)){
		$custom_order_id .= '-'.$destination_code;
	}

	if($transportorder->travel_time){		
		$custom_order_id .= '.'.$transportorder->travel_time;
	}
	

	 return $custom_order_id;

}
function getCityCountryShortName($city_id) {
	$city = City::find($city_id);
	$citycode = '';
	if(!empty($city)){
		$citycode = $city->citycode;
	}
	return $citycode;
} 
function getCountryShortName($country_id) {
	$country = Country::find($country_id);
	$code2l = '';
	if(!empty($country)){
		$code2l = $country->code2l;
	}	
	return $code2l;	
} 
function getCurrency($currency_code){
	return 	Currency::where("code",$currency_code)->first();
}
function getLatestNews(){
		$news = News::where('status',1)->orderBy('id', 'desc')->first();
		return $news->slug;
}
function getTutorCourses($course_ids){
	$course_ids = explode(",", $course_ids);	
	$couses =  Course::whereIn('id', $course_ids)->get();
	if(!empty($couses) && count($couses)>0 ){
		$course_title = array();
		foreach($couses as $row){
			$course_title[] =  $row->title;
		}
		$couse_title_list = implode(", ",$course_title);
		return '<div class="tutor-subject"><span>('.$couse_title_list.')</span></div>';
	}
    
}

function getTeachingLocation(){
	return [
		1=>"Student's Home",
		2=>"Tutor's Home",
		3=>"Online",
		4=>"Public Place"
	];
}

function getBookingStatus(){
	return [
		1=>'Pending',
		2=>'Confirmed',
		3=>'Cancel',
	];
}

function getPaymentStatus(){
	return [
		'pending'=>'Pending',
		'paid'=>'Paid',
		'cancel'=>'Cancelled',
		'refund'=>'Refund',
	];
}

function getEnquiryStatus(){
	return [
		1=>'Running',
		2=>'Reported',
		3=>'Closed',
	];
}

function getBookingDuration(){
	$durations = [];
    for ($hours = 1; $hours <= 8; $hours++) {
        for ($minutes = 0; $minutes < 60; $minutes += 15) {
            $totalMinutes = ($hours * 60) + $minutes;
            $label = $hours . ' hour' . ($hours > 1 ? 's' : '');
            if ($minutes > 0) {
                $label .= ' ' . $minutes . ' minutes';
            }
            $durations[$totalMinutes] = $label;
        }
    }
	
	return $durations;
}

function getStudentPrice($hourly_rate){
	$percentage = config('constants.SITE.STUDENT_RATE');
	$increment = ($hourly_rate * $percentage) / 100;
	$student_price = $hourly_rate + $increment;
	/* 
		Example:
		$hourly_rate = 10
		ceil  return 13 from 12.5
		floor return 12 from 12.5
	*/
	return floor($student_price);
}

function getHourList(){
	$hours = [];
    
    for ($i = 0; $i < 24; $i++) {
        $hourValue = str_pad($i, 2, '0', STR_PAD_LEFT); // Ensures two-digit format (e.g., 01, 02)
        $hourLabel = ($i < 12) ? "$hourValue am" : (($i == 12) ? "12" : "$hourValue");
        
        $hours[$hourValue] = $hourLabel;
    }

    return $hours;
}


if (!function_exists('format_label')) {
    function format_label($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }
}

function getSubjectList(){
	$subjects = Subject::getSubjectList();
	return $subjects;
}

function getLevelList(){
	$levels = Level::getLevelList();
	return $levels;
}

function getCountyNameById($county_id){
	return \App\Models\County::getCountyNameById($county_id);
}

function getUserTagged($user_from_id, $user_to_id){
	return \App\Models\Tag::getUserTagged($user_from_id, $user_to_id);
}

function getTutorByCounty(){
	
	$counties = \App\Models\County::with([
		'tutors' => function ($query) {
			$query->whereHas('subject_tutors') // Ensure tutors have subject_tutors
				  ->with('subject_tutors')
				  ->distinct();
		}
	])->whereHas('tutors.subject_tutors') // Ensure counties have at least one tutor with subject_tutors
	->get();
	
	return $counties;
}

function getTutorByTown(){
	$tutor = \App\Models\Tutor::with(['subject_tutors'])
					->whereHas('subject_tutors')
					->distinct()
					->get()
					->groupBy('town');
	
	return $tutor;
}

function getTutorByTownStatic(){
	$town_subjects = [
		'London' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'chemistry' => 'Chemistry'
		],
		'Birmingham' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'biology'   => 'Biology'
		],
		'Glasgow' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'extra'    => '11+'
		],
		'Liverpool' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'french'    => 'French'
		],
		'Sheffield' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'spanish'   => 'Spanish'
		],
		'Newcastle' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'extra'    => '14+'
		],
		'Edinburgh' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'physics'   => 'Physics'
		],
		'Leeds' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'history'   => 'History'
		],
		'Manchester' => [
			'maths'         => 'Maths',
			'english'       => 'English',
			'engineering'   => 'Engineering'
		],
		'Bradford' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'psychology' => 'Psychology'
		],
		'Bristol' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'german'    => 'German'
		],
		'Coventry' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'arabic'    => 'Arabic'
		],
		'Belfast' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'geography' => 'Geography'
		],
		'Cardiff' => [
			'maths'     => 'Maths',
			'english'   => 'English',
			'it'        => 'IT'
		],
	];

	return $town_subjects;
	
}

function getAmount($amount){
	return config('constants.CURRENCY_SYMBOL').intval($amount); 
}

function getMonthlyEnquiryCount($user_id){

	// Get start and end of current month
	$startOfMonth = Carbon::now()->startOfMonth();
	$endOfMonth = Carbon::now()->endOfMonth();

	$monthlyEnquiryCount = \App\Models\Enquiry::where('sender_id', $user_id)
					->whereBetween('created_at', [$startOfMonth, $endOfMonth])
					->count();
					
	return $monthlyEnquiryCount;
}


function getEnquiryByContractId($contract_id){
	$bookingContract = \App\Models\BookingContract::where('contract_id', $contract_id)->first();
	if(!empty($bookingContract)){
		$bookingEnquiry = \App\Models\BookingEnquiry::where('booking_id', $bookingContract->booking_id)->first();
		
		if(!empty($bookingEnquiry)){
			return $bookingEnquiry->enquiry_id;
		}
	}
	return 0;
}


if (!function_exists('static_cities')) {
    function static_cities()
    {
        return [
            'Aberdeen',
            'Belfast',
            'Birmingham',
            'Bolton',
            'Bradford',
            'Bristol',
            'Cardiff',
            'Coventry',
            'Derby',
            'Edinburgh',
            'Glasgow',
            'Leeds',
            'Leicester',
            'Liverpool',
            'London',
            'Luton',
            'Manchester',
            'Northampton',
            'Nottingham',
            'Plymouth',
            'Portsmouth',
            'Reading',
            'Sheffield',
            'Southampton',
            'Westminster',
            'Wolverhampton',
        ];
    }

	
}
