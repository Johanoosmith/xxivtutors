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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

function getCityCourses($cityid){
	return Course::where('status',1)->whereRaw('FIND_IN_SET(?, cities)', [$cityid])->get();

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
